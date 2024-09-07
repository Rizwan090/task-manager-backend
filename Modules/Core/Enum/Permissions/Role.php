<?php

namespace Modules\Core\Enum\Permissions;

enum Role: string {
    case GET_ROLES = "get roles";
    case SHOW_ROLE = "show role";
    case STORE_ROLE = "store role";
    case DELETE_ROLE = "delete role";
    case UPDATE_ROLE = "update role";
}
