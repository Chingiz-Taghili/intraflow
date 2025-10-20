<?php

namespace App\Enums;

enum RequisitionStatus: string
{
    case DRAFT = 'draft';
    case PENDING_LEADER = 'pending_leader';
    case APPROVED_LEADER = 'approved_leader';
    case REJECTED_LEADER = 'rejected_leader';
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case FORWARDED = 'forwarded';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
