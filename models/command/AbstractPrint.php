<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2015 (original work) Open Assessment Technologies SA
 *
 * @author Mikhail Kamarouski, <Komarouski@1pt.com>
 */
namespace oat\taoTestTaker\models\command;


abstract class AbstractPrint implements CommandInterface
{


    public function invoke( array $testTakers, array $options = array() )
    {
        $result = array();
        try {
            $renderer = new \Renderer();
            $renderer->setTemplate( $this->getTemplate() );
            $renderer->setData( 'testTakers', $testTakers );
            $html = $renderer->render();
            $result['messages']['success'][]=__('Printable version was prepared');
        } catch ( \Exception $e ) {
            $result['messages']['error'] = $e->getMessage();
        }
        $result['html'] = $html;

        return $result;
    }

    abstract protected function getTemplate();
}