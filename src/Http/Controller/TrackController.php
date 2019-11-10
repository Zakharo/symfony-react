<?php

namespace App\Http\Controller;

use App\Entity\Track;
use App\Http\Exception\AppException;
use App\Http\Handler\CreateTrackHandler;
use App\Http\Request\CreateTrackRequest;
use App\Http\Transformer\ModelTransformer;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TrackController extends BaseController
{
    /**
     * @Route("/tracks", methods={"GET"}, name="get_tracks")
     * @param TrackRepository $repository
     * @return JsonResponse
     */
    public function showAll(
        TrackRepository $repository
    ) {
        return $this->collection($repository->findAll(), new ModelTransformer());
    }

    /**
     * @Route("/track", methods={"POST"}, name="create")
     * @param CreateTrackRequest $request
     * @param CreateTrackHandler $handler
     * @return JsonResponse
     */
    public function create(
        CreateTrackRequest $request,
        CreateTrackHandler $handler
    ) {
        $handler($request);

        return $this->json(['success' => true]);
    }

    /**
     * @Route("/track/{id}", requirements={"id"}, methods={"DELETE"}, name="delete")
     * @param int $id
     * @param TrackRepository $repository
     * @return JsonResponse
     */
    public function delete(int $id, TrackRepository $repository)
    {
        $track = $repository->findOneById($id);
        if (!$track instanceof Track) {
            throw new AppException('Track not found', 404);
        }

        $this->getDoctrine()->getManager()->remove($track);
        $this->flushChanges();

        return $this->json(['success' => true]);
    }
}
