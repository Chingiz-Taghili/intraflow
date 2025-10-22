<?php

namespace App\Policies;

use App\Enums\RequisitionStatus;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RequisitionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Requisition $requisition): bool
    {
        return $user->hasRole('admin') || $user->id === $requisition->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Requisition $requisition): bool
    {
        return $user->hasRole('admin') || $user->id === $requisition->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Requisition $requisition): bool
    {
        return $user->hasRole('admin') || $user->id === $requisition->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Requisition $requisition): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Requisition $requisition): bool
    {
        return false;
    }

    public function changeStatus(User $user, Requisition $requisition): bool
    {
        if (in_array(request()->input('status'), [
            RequisitionStatus::APPROVED_LEADER->value,
            RequisitionStatus::REJECTED_LEADER->value,])) {
            return $user->hasRole('admin') || $user->id === $requisition->user->department->leader_id;
        }

        $responsibleIds = $requisition->category->categoryResponsibles->pluck('user_id');
        if (in_array(request()->input('status'), [
            RequisitionStatus::ACCEPTED->value,
            RequisitionStatus::REJECTED->value,
            RequisitionStatus::FORWARDED->value,
            RequisitionStatus::IN_PROGRESS->value,
            RequisitionStatus::COMPLETED->value,])) {
            return $responsibleIds->contains($user->id);
        }

        if (request()->input('status') === RequisitionStatus::CANCELLED->value) {
            return $user->id === $requisition->user_id;
        }

        return false;
    }
}
