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

namespace Bunny\Wordpress\Admin\Controller;

use Bunny\Wordpress\Admin\Container;

class About implements ControllerInterface
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run(bool $isAjax): void
    {
        $headerValues = ['Cdn-Requestid' => $_SERVER['HTTP_CDN_REQUESTID'], 'Via' => $_SERVER['HTTP_VIA']];
        $headers = [];
        foreach ($headerValues as $key => $value) {
            $headers[] = $key.': '.(empty($value) ? '<em>undefined</em>' : '<code>'.esc_attr($value).'</code>');
        }
        $this->container->renderTemplateFile('about.php', ['debugInformationHtml' => ['Version' => esc_html(BUNNYCDN_WP_VERSION), 'Request headers' => implode('<br />', $headers), 'CDN acceleration override' => defined('BUNNYCDN_FORCE_ACCELERATED') ? $this->getHtmlTyped(BUNNYCDN_FORCE_ACCELERATED) : '<em>not set</em>']], ['cssClass' => 'about']);
    }

    /**
     * @param mixed $value
     */
    private function getHtmlTyped($value): string
    {
        $type = gettype($value);
        if ('boolean' === $type) {
            $value = true === $value ? 'true' : 'false';
        }

        return '<em>'.$type.'</em> '.esc_html($value);
    }
}
