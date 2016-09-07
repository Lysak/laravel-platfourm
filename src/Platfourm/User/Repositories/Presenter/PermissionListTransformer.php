<?php
/*
 * This file is part of the Laravel Platfourm package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PermissionListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Permission $permission)
    {
        return [
            'id'   => $permission->getRouteKey(),
            'name' => $permission->name,
            'slug' => $permission->slug,
        ];
    }
}
