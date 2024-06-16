<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FSA\Telegram\TelegramBotApi;
use FSA\Telegram\TelegramBotQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GammuSmsdController extends AbstractController
{

    #[Route('/gammu-smsd/{id}', requirements: ['id' => '\d+'])]
    public function gammu_smsd(int $id, TelegramBotApi $telegramBotApi, TelegramBotQuery $telegramBotQuery, EntityManagerInterface $entityManager): JsonResponse
    {
        $connection = $entityManager->getConnection();
        $msg = $connection->executeQuery('SELECT "SenderNumber" as num, "TextDecoded" as text FROM inbox WHERE "ID"=?', [$id])->fetchAssociative();
        if ($msg or !$msg['text']) {
            return $this->json(['status' => 200, 'message' => $msg]);
        }
        $result = $telegramBotQuery->httpPost(
            $telegramBotApi->sendMessage(
                $this->getParameter('telegram.channel.admin'),
                "Пришло SMS от " . $msg['num'] . ":\n" . $msg['text']
            )
        );
        return $this->json(['status' => 200, 'response' => $result->ok]);
    }
}
