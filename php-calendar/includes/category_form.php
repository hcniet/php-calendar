<?php
/*
 * Copyright 2010 Sean Proctor
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if(!defined('IN_PHPC')) {
       die("Hacking attempt");
}

require_once("$phpc_includes_path/form.php");

function category_form() {
	global $phpc_script, $vars, $phpcdb, $phpcid;

        $form = new Form($phpc_script, _('Category Form'));
        $form->add_part(new FormFreeQuestion('name', _('Name'),
				false, 32, true));
        $form->add_part(new FormFreeQuestion('text-color',
                                _('Text Color')));
        $form->add_part(new FormFreeQuestion('bg-color',
                                _('Background Color')));

	if(isset($vars['cid']))
		$form->add_hidden('cid', $vars['cid']);

	$form->add_hidden('action', 'category_submit');
	$form->add_part(new FormSubmitButton("Submit Category"));

	if(isset($vars['catid'])) {
		$form->add_hidden('catid', $vars['catid']);
		$category = $phpcdb->get_category($vars['catid']);
		$defaults = array(
				'name' => htmlspecialchars($category['name']),
				'text-color' => htmlspecialchars($category['text_color']),
				'bg-color' => htmlspecialchars($category['bg_color']),
				);
	} else {
		$defaults = array();
	}
        return $form->get_html($defaults);
}

?>