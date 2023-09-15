import confirm from '@inquirer/confirm';
import { input } from '@inquirer/prompts';
import select from '@inquirer/select';
import { exec } from 'child_process';
import { mkdir, readdir, readFile, writeFile } from 'fs/promises';
import { colorPicker, div, image, repeater } from './html.mjs';
import { dirname, join } from 'path';
import prettier from 'prettier';
import { fileURLToPath } from 'url';

// https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/.

const acfKey = await selectACFFieldGroup();
const acfFieldGroup = await getACFJSON(acfKey);
const fields = extractFields(acfFieldGroup.fields);

const folderName = await input({
	message: 'Enter the folder name (also used for filenames)',
	default: 'test-block',
});

const name = await input({
	message: 'Enter the block name (e.g. acf/test)',
	default: `acf/${folderName}`,
});

const title = await input({
	message: 'Enter the block title',
	default: 'Test Block',
});

const category = await input({
	message:
		'Enter the block category (e.g. text, media, design, widgets, theme, embed)',
});

const icon = await input({ message: 'Enter the icon - accepts SVGs' });

const description = await input({ message: 'Enter the description' });

const keywords = await input({
	message: 'Enter the keyword(s) (separate by commas)',
});

const acf = await select({
	message: 'Select ACF specific block configuration',
	choices: [
		{
			name: 'preview',
			value: 'preview',
			description:
				'Preview is always shown. The edit form will appear in the sidebar when the block is selected.',
		},
		{
			name: 'auto',
			value: 'auto',
			description:
				'Preview is shown by default but changes to edit form when block is selected.',
		},
		{
			name: 'edit',
			value: 'edit',
			description: 'Edit form is always shown.',
		},
	],
});

const hasInnerBlocks = await confirm({
	message: 'Are you using InnerBlocks?',
});

const hasJavaScript = await confirm({
	message: 'Does the block use JavaScript?',
});

const hasVendorJavaScript = await confirm({
	message: 'Does the block use third-party JavaScript?',
});

const hasVendorCSS = await confirm({
	message: 'Does the block use third-party CSS?',
});

const keywordsArray = keywords
	.split(',')
	.map((keyword) => `"${keyword.trim()}"`);

const keywordsString = `[${keywordsArray.join(', ')}]`;

const script =
	hasJavaScript && hasVendorJavaScript
		? `\n\t"script": ["block-${folderName}", "block-${folderName}-vendor"],`
		: hasJavaScript
		? `\n\t"script": ["block-${folderName}"],`
		: '';

const style = hasVendorCSS
	? `"style": ["file:./assets/${folderName}.min.css", "file:./assets/${folderName}.vendor.css"]`
	: `"style": ["file:./assets/${folderName}.min.css"]`;

// prettier-ignore
// NOTE: Make sure these are 4 spaces, not 2 per JSON spec.
const blockJson = JSON.stringify(
  `{
    "$schema": "https://schemas.wp.org/trunk/block.json",
    "name": "${name}",
    "title": "${title}",
    "description": "${description}",
    "category": "${category}",
    "icon": "${icon}",
    "keywords": ${keywordsString},
    "supports": {
        "anchor": true,
        "align": ["wide", "full"],
        "spacing": {
            "margin": true,
            "padding": true
        }
    },
    "acf": {
        "mode": "${acf}",
        "renderTemplate": "${folderName}.php"
    },${script}
    "editorStyle": "file:./assets/editor.min.css",
    ${style}
}`
);

const markup = createMarkupByType(fields);
const allowedBlocks = createAllowedBlocks();

await createFolder(folderName);

async function createFolder(folderName) {
	try {
		const vendorBinPath = getDirectoryPath('../../vendor/bin/');
		const folderPath = getDirectoryPath(`../../blocks/${folderName}`);

		await mkdir(folderPath, { recursive: true });
		console.log(`Folder ${folderName} created successfully!`);

		const files = [
			{
				fileName: join(folderPath, 'block.json'),
				fileContent: JSON.parse(blockJson, null, 2),
			},
			{
				fileName: join(folderPath, `${folderName}.php`),
				fileContent: `<?php
/**
 * ${title} block.
 *
 * @package Hoverboard
 */

${allowedBlocks}
?>

${markup}`,
			},
			{
				fileName: join(folderPath, `${folderName}.css`),
				fileContent: `.wp-block-acf-${folderName} { color: red; }`,
			},
			{
				fileName: join(folderPath, 'editor.css'),
				fileContent: '',
			},
		];

		if (hasJavaScript) {
			files.push({
				fileName: join(folderPath, `${folderName}.js`),
				fileContent: `(() => {
	Array.from(document.querySelectorAll(\`.wp-block-acf-${folderName}\`)).map((element) => {
		// Add data-options attribute to the block to pass options to the JavaScript.
		// const options = JSON.parse(element.options);

		console.log(element);
	});
})();`,
			});
		}

		if (hasVendorJavaScript) {
			files.push({
				fileName: join(folderPath, `${folderName}.vendor.js`),
				fileContent: `console.log('${folderName}.vendor.js');`,
			});
		}

		for (const { fileName, fileContent } of files) {
			await writeFile(fileName, fileContent);
			console.log(`File "${fileName}" created successfully!`);
		}

		exec(
			`${vendorBinPath}phpcbf --standard=WordPress ${folderPath}/${folderName}.php`,
			(error, stdout, stderr) => {
				console.log(`stdout: ${stdout}`);
			}
		);
	} catch (err) {
		console.error('Error creating folder:', err);
	}
}

function createMarkupByType(fields) {
	if (!hasInnerBlocks) {
		return false;
	}

	let html = '';

	let wrapStart = `<section <?php echo wp_kses_post( $block['block_wrapper_attributes'] ); ?>>`;
	fields.forEach((field) => {
		switch (field.type) {
			case 'image':
				html += image(`wp-block-acf-${folderName}`, field.name);
				break;
			case 'color_picker':
				html += colorPicker(`wp-block-acf-${folderName}`, field.name);
				break;
			case 'repeater':
				html += repeater(
					`wp-block-acf-${folderName}`,
					field.name,
					field.subFields
				);
				break;
			default:
				html += div(`wp-block-acf-${folderName}`, field.name);
				break;
		}
	});
	if (hasInnerBlocks) {
		html += `<div class="wp-block-acf-${folderName}__text">
		<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" />
	</div>`;
	}
	let wrapEnd = '</section>';
	html = prettier.format(html, {
		parser: 'html',
		printWidth: 9999,
		useTabs: true,
	});
	return wrapStart + html + wrapEnd;
}

function createAllowedBlocks() {
	let html = `$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/buttons' );`;

	html += `$template = array(
		array(
			'core/paragraph',
			array(
				'content' => 'Content here…',
			),
		),
	);`;

	return html;
}

async function selectACFFieldGroup() {
	try {
		const data = await getACFJSON();
		const choices = data.map(({ name, value, description }) => ({
			name,
			value,
			description,
		}));
		return await select({
			message: 'Select the ACF field group',
			choices,
		});
	} catch (error) {
		console.error('Error selecting ACF field group:', error);
		return false;
	}
}

async function getACFJSON(acfKey) {
	try {
		const directoryPath = getDirectoryPath('../../acf-json');
		const fileNames = await readdir(directoryPath);
		const data = [];

		for (const fileName of fileNames) {
			if (fileName.includes(acfKey)) {
				const fileData = await readFile(join(directoryPath, fileName), 'utf8');
				const json = JSON.parse(fileData);
				const { title, description, key, fields } = json;
				return { name: title, value: key, description, fields };
			}

			if (fileName.includes('group_')) {
				const fileData = await readFile(join(directoryPath, fileName), 'utf8');
				const json = JSON.parse(fileData);
				const isBlock = json.title.includes('Block');

				if (isBlock) {
					const { title, description, key, fields } = json;
					data.push({ name: title, value: key, description, fields });
				}
			}
		}

		return data;
	} catch (error) {
		console.error('Error reading file:', error);
		return false;
	}
}

function getDirectoryPath(targetDirectory) {
	const currentFilePath = fileURLToPath(import.meta.url);
	const currentDirectory = dirname(currentFilePath);
	return join(currentDirectory, targetDirectory);
}

function extractFields(acfFieldGroup) {
	return acfFieldGroup.map((field) => {
		const { choices, label, name, type, sub_fields: subFields } = field;
		return subFields
			? { choices, label, name, type, subFields: extractFields(subFields) }
			: { choices, label, name, type, subFields };
	});
}
