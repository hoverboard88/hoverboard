import {
	useBlockProps,
	InspectorControls,
	InnerBlocks,
} from "@wordpress/block-editor";
import { PanelBody, PanelRow, RadioControl } from "@wordpress/components";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 */
export default function AccordionEdit({ attributes, setAttributes }) {
	const { openContent, openContentSelected, options, selected } = attributes;
	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelBody title="Settings" initialOpen={true}>
					<PanelRow>
						<RadioControl
							label="Open First Panel"
							selected={openContentSelected}
							options={openContent}
							onChange={(openContentSelected) => {
								setAttributes({ openContentSelected });
							}}
						/>
					</PanelRow>
					<PanelRow>
						<RadioControl
							label="Content Options"
							selected={selected}
							options={options}
							onChange={(selected) => {
								setAttributes({ selected });
							}}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<InnerBlocks
					template={[["hb-blocks/accordion-item"]]}
					allowedBlocks={["hb-blocks/accordion-item"]}
				/>
			</div>
		</>
	);
}
