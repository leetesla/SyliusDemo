<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Generator;

use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
final class VerificationFlashMessageGenerator implements FlashMessageGeneratorInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var ChannelContextInterface
     */
    private $channelContext;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ChannelContextInterface $channelContext
     * @param TranslatorInterface $translator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        ChannelContextInterface $channelContext,
        TranslatorInterface $translator
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->channelContext = $channelContext;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($token)
    {
        $url = $this->urlGenerator->generate('sylius_shop_user_verification', ['token' => $token]);
        $message = $this->translator->trans('sylius_demo.verification_link_flash', [
            '%url%' => 'http://'.$this->channelContext->getChannel()->getHostname().$url,
        ]);

        return $message;
    }
}
