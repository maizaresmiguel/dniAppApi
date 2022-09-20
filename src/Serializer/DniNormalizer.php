<?php
// src/Serializer/TopicNormalizer.php
namespace App\Serializer;

use App\Entity\Dni;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DniNormalizer implements ContextAwareNormalizerInterface
{
    //private $router;
    private $normalizer;

    public function __construct(UrlGeneratorInterface $router, ObjectNormalizer $normalizer)
    {
        //$this->router = $router;
        $this->normalizer = $normalizer;
    }

    public function normalize($dni, string $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($dni, $format, $context);

            $data['mensaje'] = 'mensajde desde el dninormalizer!!!';

        return $data;
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Dni;
    }
}