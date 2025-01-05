<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class JsonResponses extends JsonResource
{
    private $status;
    private $message;
    private $data;

    public function __construct($status, $message, $data){
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'response_at' => Carbon::now()
            ->format('d/m/Y H:i:s')
        ];
    }
}
