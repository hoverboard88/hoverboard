export function colorPicker(block, fieldName, fieldVariable = '$fields') {
	return `<div class="${block}__${fieldName}" style="background-color: <?php echo esc_attr( ${fieldVariable}['${fieldName}'] ); ?>"></div>`;
}

export function div(block, fieldName, fieldVariable = '$fields') {
	return `<div class="${block}__${fieldName}"><?php echo esc_html( ${fieldVariable}['${fieldName}'] ); ?></div>`;
}

export function image(block, fieldName, fieldVariable = '$fields') {
	return `
	<div class="${block}__${fieldName}">
		<?php
		get_template_part(
			'parts/image/image',
			null,
			array(
				'image'         => ${fieldVariable}['${fieldName}'],
				'size'          => 'large',
				'default_image' => true,
			)
		);
		?>
	</div>
`;
}

export function repeater(
	block,
	fieldName,
	subFields,
	fieldVariable = '$fields'
) {
	let html = `<div class="${block}__${fieldName}">`;
	html += `<?php foreach ( ${fieldVariable}['${fieldName}'] as $field ) : ?>`;
	subFields.forEach((field) => {
		switch (field.type) {
			case 'image':
				html += image(block, field.name, '$field');
				break;
			case 'color_picker':
				html += colorPicker(block, field.name, '$field');
				break;
			case 'repeater':
				html += repeater(block, field.name, field.subFields, '$field');
				break;
			default:
				html += div(block, field.name, '$field');
				break;
		}
	});
	html += `<?php endforeach; ?>`;
	html += '</div>';
	return html;
}
