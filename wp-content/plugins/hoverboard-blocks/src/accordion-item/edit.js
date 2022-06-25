/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
import { RichText, useBlockProps } from "@wordpress/block-editor";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {WPElement} Element to render.
 */
export default function edit({ className, attributes, setAttributes }) {
	const blockProps = useBlockProps();
	return (
		<div {...blockProps}>
			<RichText
				tagName="h2"
				className={className}
				value={attributes.heading}
				placeholder="Add text"
				onChange={(heading) => setAttributes({ heading })}
			/>
			<RichText
				tagName="p"
				className={className}
				value={attributes.content}
				placeholder="Add text"
				onChange={(content) => setAttributes({ content })}
			/>
		</div>
	);
}
