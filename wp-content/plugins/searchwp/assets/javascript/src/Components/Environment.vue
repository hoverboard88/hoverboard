<template>
	<div class="searchwp-alternate-indexer">
		<Notice v-if="memoryLimits && !memoryLimits.sufficient"
			:type="'warning'"
			:message="'_memory_limit_note' | i18n([memoryLimits.recommended, memoryLimits.wp, memoryLimits.php])"
			:more="{
				target: 'https://searchwp.com/?p=299348',
				text: moreInfoText
			}"
		></Notice>
		<Notice v-if="!cron"
			:type="'warning'"
			:message="'_cron_note' | i18n"
			:more="{
				target: 'https://searchwp.com/?p=299347',
				text: moreInfoText
			}"
		></Notice>
		<Notice v-if="suggestAlternateIndexer && 'alternate' !== type"
			:type="'warning'"
			:message="'_suggest_alternate_indexer_note' | i18n"
			:more="{
				target: 'https://searchwp.com/?p=223030',
				text: moreInfoText
			}"
		></Notice>
		<Notice v-if="'alternate' === type"
			:type="'warning'"
			:message="altIndexMessage()"
			:more="{
				target: 'https://searchwp.com/?p=223030',
				text: moreInfoText
			}"
			:tooltip="'_http_loopback_note' | i18n"
		></Notice>
		<Notice v-else-if="'basicauth' === type"
			:type="'error'"
			:message="'_indexer_blocked_note' | i18n"
			:more="{
				target: 'https://searchwp.com/?p=223034',
				text: httpBasicAuthLinkText
			}"
		></Notice>
	</div>
</template>

<script>
import Notice from './Notice.vue';
import { __ } from './../helpers.js';

export default {
	name: 'AlternateIndexer',
	props: {
		suggestAlternateIndexer: {
			type: Boolean,
			required: false,
			default: false
		}
	},
	components: {
		Notice
	},
	computed: {
		moreInfoText: function() {
			return __('More Info');
		},
		httpBasicAuthLinkText: function() {
			return __('Fix this');
		}
	},
	methods: {
		altIndexMessage: function() {
			if(this.$store.state.index.indexed != 0 && this.$store.state.index.indexed == this.$store.state.index.total) {
				return __('_alternate_indexer_done');
			} else {
				return __('_alternate_indexer_note');
			}
		},
		triggerIndexer: function() {
			let vm = this;

			jQuery.post(ajaxurl, {
				_ajax_nonce: _SEARCHWP.nonce,
				action: _SEARCHWP.prefix + 'trigger_indexer'
			}, function(response) {
				setTimeout(function() {
					vm.triggerIndexer();
				}, 5000);
			});
		}
	},
	created() {
		let vm = this;

		jQuery.post(ajaxurl, {
			_ajax_nonce: _SEARCHWP.nonce,
			action: _SEARCHWP.prefix + 'indexer_method'
		}, function(response) {
			if (!response.success) {
				alert(__('Indexer communication error. See console.'));
			} else {
				vm.type = response.data;

				// If it's the alternate indexer, we need to kick it off.
				if ('alternate' == vm.type) {
					vm.triggerIndexer();
				}
			}
		});

		jQuery.post(ajaxurl, {
			_ajax_nonce: _SEARCHWP.nonce,
			action: _SEARCHWP.prefix + 'memory_limits'
		}, function(response) {
			if (response.success) {
				vm.memoryLimits = response.data;
			}
		});
	},
	data() {
		return {
			type: 'default',
			memoryLimits: null,
			cron: !!_SEARCHWP.cron,
		}
	}
}
</script>

<style lang="scss">

</style>
