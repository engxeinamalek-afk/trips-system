<?php
namespace App\Services\Contracts;

interface TicketServiceInterface {
    public function createTicket(array $data): array;
}