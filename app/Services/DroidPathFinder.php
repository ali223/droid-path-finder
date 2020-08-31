<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Generator;

class DroidPathFinder
{
    private $apiUrl;
    private $path;
    private $lastMapLine;
    private $lastCrashMapLine;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
        $this->path = '';
        $this->lastMapLine = '';
        $this->lastCrashMapLine = '';
    }

    public function navigatePath(): Generator
    {
        do {
            $this->moveForward();
            $response = Http::get($this->getRequestUrl());
            $responseData = $response->json();

            if ($this->isCrashedResponse($response)) {
                $this->storeLastCrashMapLine($responseData['map']);
                $this->correctPath();
                continue;
            }

            $this->storeLastMapLine($responseData['map']);
            yield $this->lastMapLine;
        } while ($this->isDestinationNotReached($response));

        yield $responseData['message'];
    }

    public function getPath(): string
    {
        return $this->path;
    }

    private function getRequestUrl(): string
    {
        $query = http_build_query([
            'name' => 'my-droid',
            'path' => $this->path,
        ]);

        return $this->apiUrl . "?{$query}";
    }

    private function isCrashedResponse(Response $response): bool
    {
        return $response->status() === 417;
    }

    private function isDestinationNotReached(Response $response): bool
    {
        return $response->status() !== 200;
    }

    private function moveForward(): void
    {
        $this->path .= 'f';
    }

    private function removeLastForwardMovement(): void
    {
        if (substr($this->path, -1, 1) === 'f') {
            $this->path = substr($this->path, 0, -1);
        }
    }

    private function moveHorizontally(int $numberOfPlaces): void
    {
        if ($numberOfPlaces > 0) {
            $this->moveRight($numberOfPlaces);
        } else {
            $this->moveLeft(abs($numberOfPlaces));
        }
    }

    private function moveRight(int $numberOfPlaces = 1): void
    {
        $this->path .= str_repeat('r', $numberOfPlaces);
    }

    private function moveLeft(int $numberOfPlaces = 1): void
    {
        $this->path .= str_repeat('l', $numberOfPlaces);
    }

    private function storeLastMapLine(string $map): void
    {
        $mapLines = explode("\n", $map);
        $this->lastMapLine = $mapLines[count($mapLines)-1];
    }

    private function storeLastCrashMapLine(string $map): void
    {
        $mapLines = explode("\n", $map);
        $this->lastCrashMapLine = $mapLines[count($mapLines)-1];
    }

    private function correctPath(): void
    {
        $this->removeLastForwardMovement();

        $numberOfPlacesToMove = ($this->getNextAvailablePosition() - $this->getCurrentPosition());

        $this->moveHorizontally($numberOfPlacesToMove);
    }

    private function getCurrentPosition(): int
    {
        return strpos($this->lastMapLine, '*');
    }

    private function getNextAvailablePosition(): int
    {
        $availablePosition = strpos($this->lastCrashMapLine, ' ');

        while ($this->lastMapLine[$availablePosition] !== ' ') {
            $availablePosition++;
        }

        return $availablePosition;
    }
}
