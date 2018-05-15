const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'starter-theme/test-block', {
	title: __( 'Test Block' ),
	icon: 'admin-appearance',
	category: 'common',
	edit( { className } ) {
		return (
			<div className="test-block">Block with styles. Built with JSX.</div>
		);
	},
	save( { className } ) {
		return (
      <div className="test-block">Block with styles. Built with JSX.</div>
		);
	},
} );
