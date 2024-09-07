<?php

namespace Modules\Core\Enum\Permissions;

enum Permission: string {
    case GET_PERMISSIONS = "get permissions";
    case SHOW_PERMISSION = "show permission";
    case STORE_PERMISSION = "store permission";
    case DELETE_PERMISSION = "delete permission";
    case UPDATE_PERMISSION = "update permission";
}
