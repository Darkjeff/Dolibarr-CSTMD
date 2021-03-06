<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/** Includes */
require __DIR__ . '/../vendor/autoload.php';
include_once DOL_DOCUMENT_ROOT.'/includes/parsedown/Parsedown.php';

/**
 * Class ParsedownDolibarr
 */
class ParsedownDolibarr extends Parsedown
{
    /**
     * Resolve inline images relative URLs to the module's path
     *
     * @param $Excerpt
     * @return array|void
     */
    protected function inlineImage($Excerpt)
    {
        $image = parent::inlineImage($Excerpt);
        $path = new \Enrise\Uri($image['element']['attributes']['src']);
        if ($path->isRelative()) {
            $image['element']['attributes']['src'] = dol_buildpath('/icstmd/' . $path, 1);
        }
        return $image;
    }
}
