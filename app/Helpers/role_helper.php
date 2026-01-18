<?php

function hasRole($role)
{
    return session()->get('role') === $role;
}
