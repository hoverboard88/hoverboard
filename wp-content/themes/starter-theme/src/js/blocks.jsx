const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'mdlr/styles-jsx-example', {
	title: __( 'Block Styles JSX Example 2' ),
	icon: 'admin-appearance',
	category: 'common',
	edit( { className } ) {
		return (
			<div className={ className }>Block with styles. Built with JSX.</div>
		);
	},
	save( { className } ) {
		return (
			<div className={ className }>Block with styles. Built with JSX.</div>
		);
	},
} );
