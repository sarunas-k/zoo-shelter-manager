<?php

namespace App\Repositories;

use App\Animal;
use App\Call;
use App\Person;
use App\Repositories\Interfaces\ICallsRepository;

class CallsRepository implements ICallsRepository {

    public function all() {
        return Call::all();
    }

    public function allPaginated($perPage = 10) {
        return Call::latest()->paginate($perPage);
    }

    public function get($id) {
        $call = Call::find($id);
        if ($call !== null)
            $this->formatFieldsForPresentation($call);

            return $call;
    }

    public function addFromInput($formFields) {
        Call::create([
            'date_time' => $formFields['call-date'],
            'caller_name' => $formFields['caller-name'],
            'caller_phone' => $formFields['caller-phone'],
            'address' => $formFields['address'],
            'info' => $formFields['details'],
            'staff_id' => $formFields['staff']
        ]);
    }

    public function updateFromInput($call, $formFields) {
        $call->update([
            'date_time' => $formFields['call-date'],
            'caller_name' => $formFields['caller-name'],
            'caller_phone' => $formFields['caller-phone'],
            'address' => $formFields['address'],
            'info' => $formFields['details'],
            'staff_id' => $formFields['staff'],
            'status' => $formFields['status']
        ]);
    }

    public function delete($call) {
        if ($call !== null)
            $call->delete();
    }

    public function deleteById($id) {
        $call = Call::find($id);
        if ($call !== null)
            $call->delete();
    }

    public function formatFieldsForPresentation($call) {
        if (!isset($call))
            return;
            
        $call->date_time_ui_input = str_replace(' ', 'T', $call->date_time);
        
        $callStatusStyles = [
            'Waiting' => 'badge-success',
            'Finished' => 'badge-secondary',
            'On hold' => 'badge-warning'
        ];
        if (isset($call->status) && isset($callStatusStyles[$call->status]))
            $call->status_style_class = $callStatusStyles[$call->status];

        return $call;
    }

}