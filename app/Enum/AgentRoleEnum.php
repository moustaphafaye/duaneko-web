<?php

namespace App\Enum;

enum AgentRoleEnum:string {
    case ADMIN = 'admin';
    case AGENT = 'agent';
    case ADMIN_AGENT = 'admin_agent';
}