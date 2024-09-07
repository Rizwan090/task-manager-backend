<?php

namespace Modules\Core\Enum\Permissions;

enum User: string {
    case GET_USERS = "get users";
    case GET_ADMINS = "get admins";
    case CREATE_ADMINS = "create admins";
    case CREATE_USERS = "create users";
    case UPDATE_USERS = "update users";
    case UPDATE_ADMINS  = "update admins";
    case DELETE_USERS = "delete users";
    case DELETE_ADMINS  = "delete admins";

    case UPDATE_USER_STATUS = "update user status";
    case UPDATE_PERMISSIONS = "update permissions";
}
