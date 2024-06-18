<?php
// bunny.net WordPress Plugin
// Copyright (C) 2024  BunnyWay d.o.o.
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

declare(strict_types=1);

// Don't load directly.
if (!defined('ABSPATH')) {
    exit('-1');
}

/**
 * @var \Bunny\Wordpress\Admin\Container $this
 * @var string|null $error
 * @var bool $canReset
 * @var bool $isAgencyMode
 */
?>
<div class="container bn-p-0">
    <?php if (null !== $error): ?>
        <div class="alert red bn-m-5">
            <?= esc_html($error) ?>
        </div>
    <?php endif; ?>
    <?php if ($canReset): ?>
        <?php if (false === $isAgencyMode): ?>
        <section class="bn-section">
            <form method="POST" autocomplete="off">
                <p><?= esc_html__('This operation will convert plugin into the Agency Mode. All local configurations will not be touched and the bunny.net services will continue to work, but you will not be able to Purge Cache or see Bunny CDN statistics, neither administrate Bunny Optimizer or Bunny Offloader directly from WordPress.', 'bunnycdn') ?></p>
                <button type="button" class="bn-button bn-button--secondary bn-mt-4" id="convert-agency-mode-btn"><?= esc_html__('Convert to Agency Mode', 'bunnycdn') ?></button>
                <input type="hidden" name="convert_agency_mode" value="yes">
                <?= wp_nonce_field('bunnycdn-save-reset') ?>
                <input type="hidden" name="convert_agency_mode_confirmed" value="0" id="modal-convert-agency-mode-confirmed">
            </form>
        </section>
        <?php endif; ?>
        <section class="bn-section bn-section--no-divider">
            <p class="bn-m-0"><?= sprintf(
                /* translators: 1: <a href=...>dash.bunny.net</a> */
                esc_html__('This operation will fully reset this plugin. All local configuration and settings will be removed. Any bunny.net platform configuration and data contained in bunny.net storage will remain unaffected. If you wish to delete files or configuration data from bunny.net systems, please log into %1$s and remove the items there.', 'bunnycdn'),
                '<a href="https://dash.bunny.net" target="_blank">dash.bunny.net</a>'
            ) ?></p>
            <form method="POST" autocomplete="off">
                <button type="button" class="bn-button bn-button--primary bn-mt-4" id="reset-btn"><?= esc_html__('Reset bunny.net plugin', 'bunnycdn') ?></button>
                <input type="hidden" name="reset" value="yes">
                <?= wp_nonce_field('bunnycdn-save-reset') ?>
                <input type="hidden" name="reset_confirmed" value="0" id="modal-reset-confirmed">
            </form>
        </section>
    <?php else: ?>
        <div class="alert red">
            <p><?= sprintf(
                /* translators: 1: <a href=...> 2: </a> */
                esc_html__('Because you are using the Content Offloading functionality, you cannot reset the settings. Read %1$sthis article%2$s for instructions on how you can decouple your WordPress from bunny.net services.', 'bunnycdn'),
                '<a href="https://support.bunny.net/hc/en-us/articles/12935895460892-How-to-move-files-from-Bunny-Storage-back-into-WordPress" target="_blank">',
                '</a>'
            ) ?></p>
        </div>
    <?php endif; ?>
</div>

<?php if (false === $isAgencyMode): ?>
    <div id="modal-convert-agency-mode" class="modal">
        <div class="modal-container">
            <img src="<?= $this->assetUrl('icon-alert.svg') ?>">
            <h2><?= esc_html__('Convert to Agency Mode?', 'bunnycdn') ?></h2>
            <p><?= sprintf(
                /* translators: 1: <a href=...>dash.bunny.net</a> */
                esc_html__('If you convert to Agency Mode, the bunny.net services in use will continue to work on your website, but you will only be able to manage them via %1$s.', 'bunnycdn'),
                '<a href="https://dash.bunny.net" target="_blank">dash.bunny.net</a>'
            ) ?></p>
            <div class="modal-confirm">
                <input type="checkbox" id="modal-convert-agency-mode-checkbox" class="bn-toggle">
                <label for="modal-convert-agency-mode-checkbox" class="bn-text-200-regular"><?= esc_html__('I understand the plugin will have limited functionality', 'bunnycdn') ?></label>
            </div>
            <div class="modal-buttons">
                <button class="bn-button bn-button--danger bn-button--lg" id="modal-convert-agency-mode-confirm" disabled><?= esc_html__('Convert to Agency Mode', 'bunnycdn') ?></button>
                <button class="bn-button bn-button--secondary bn-button--lg" id="modal-convert-agency-mode-cancel"><?= esc_html__('Cancel', 'bunnycdn') ?></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<div id="modal-reset" class="modal">
    <div class="modal-container">
        <img src="<?= $this->assetUrl('icon-alert.svg') ?>">
        <h2><?= esc_html__('Reset plugin?', 'bunnycdn') ?></h2>
        <p><?= esc_html__('If you reset this plugin, all bunny.net features will stop working.', 'bunnycdn') ?></p>
        <div class="modal-confirm">
            <input type="checkbox" id="modal-reset-checkbox" class="bn-toggle">
            <label for="modal-reset-checkbox" class="bn-text-200-regular"><?= esc_html__('I understand this action might break my website', 'bunnycdn') ?></label>
        </div>
        <div class="modal-buttons">
            <button class="bn-button bn-button--danger bn-button--lg" id="modal-reset-confirm" disabled><?= esc_html__('Reset Plugin', 'bunnycdn') ?></button>
            <button class="bn-button bn-button--secondary bn-button--lg" id="modal-reset-cancel"><?= esc_html__('Cancel', 'bunnycdn') ?></button>
        </div>
    </div>
</div>
