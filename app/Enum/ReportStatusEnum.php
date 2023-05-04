<?php

namespace App\Enum;

enum ReportStatusEnum:string {
    case PENDING='pending';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
