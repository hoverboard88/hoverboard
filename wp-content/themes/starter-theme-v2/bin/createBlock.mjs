import confirm from '@inquirer/confirm';
import { input } from '@inquirer/prompts';
import select from '@inquirer/select';
import { mkdir, readdir, readFile, writeFile } from 'fs/promises';
import { dirname, join } from 'path';

// https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/.

// const fields = [];

// const hasACFFieldGroup = await confirm({
// 	message: 'Have you created an ACF field group?',
// });

// if (hasACFFieldGroup) await getACFFieldGroup();

// console.log(JSON.stringify(fields, null, 2));

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
	? `"style": ["file:./${folderName}.css", "file:./vendor.css"]`
	: `"style": ["file:./${folderName}.css"]`;

const blockJson = JSON.stringify(
	`{
	"name": "${name}",
	"title": "${title}",
	"description": "${description}",
	"category": "${category}",
	"icon": "${icon}",
	"keywords": ${keywordsString},
	"acf": {
		"mode": "${acf}",
		"renderTemplate": "${folderName}.php"
	},${script}
	"editorStyle": "file:./editor.css",
	${style}
}`
);

createFolder(folderName);

async function createFolder(folderName) {
	try {
		const currentFilePath = new URL(import.meta.url).pathname;
		const parentDirectory = dirname(currentFilePath);
		const folderPath = join(parentDirectory, '../blocks', folderName);

		await mkdir(folderPath, { recursive: true });
		console.log(`Folder ${folderName} created successfully!`);

		const files = [
			{
				fileName: join(folderPath, 'block.json'),
				fileContent: JSON.parse(blockJson, null, 2),
			},
			{
				fileName: join(folderPath, `${folderName}.php`),
				fileContent: '<?php // silence is golden',
			},
			{
				fileName: join(folderPath, `${folderName}.css`),
				fileContent: `.wp-block-${folderName} { color: red; }`,
			},
			{
				fileName: join(folderPath, 'editor.css'),
				fileContent: '',
			},
		];

		if (hasJavaScript) {
			files.push({
				fileName: join(folderPath, `${folderName}.js`),
				fileContent: `console.log('${folderName}.js');`,
			});
		}

		if (hasVendorJavaScript) {
			files.push({
				fileName: join(folderPath, 'vendor.js'),
				fileContent: "console.log('vendor.js');",
			});
		}

		for (const { fileName, fileContent } of files) {
			await writeFile(fileName, fileContent);
			console.log(`File "${fileName}" created successfully!`);
		}
	} catch (err) {
		console.error('Error creating folder:', err);
	}
}

async function getACFFieldGroup() {
	try {
		const currentFilePath = new URL(import.meta.url).pathname;
		const parentDirectory = dirname(currentFilePath);
		const directoryPath = join(parentDirectory, '../acf-json');
		const fileNames = await readdir(directoryPath);
		const choices = [];

		for (const fileName of fileNames) {
			if (fileName.includes('group_')) {
				const filePath = join(directoryPath, fileName);
				const fileData = await readFile(filePath, 'utf8');
				const json = JSON.parse(fileData);
				const isBlock = json.title.includes('Block');

				if (isBlock) {
					fields.push(...json.fields);
					choices.push({
						name: json.title,
						value: json.title,
						description: json.description,
					});
				}
			}
		}

		return await select({
			message: 'Select the ACF field group',
			choices,
		});
	} catch (error) {
		console.error('Error selecting ACF field group:', error);
		return false;
	}
}
