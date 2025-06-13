<?php

namespace App\Enums;

enum Permission: string
{
    case ACCESS_ADMIN = 'access-admin';

    case ACCESS_USER = 'access-user';
    case CREATE_USER = 'create-user';
    case EDIT_USER = 'edit-user';
    case DELETE_USER = 'delete-user';

    case ACCESS_PRODUCT = 'access-product';
    case CREATE_PRODUCT = 'create-product';
    case EDIT_PRODUCT = 'edit-product';
    case DELETE_PRODUCT = 'delete-product';
    case VIEW_PRODUCT = 'view-product';
}
