<?php

namespace Doitcloud\EmailService\Builders;

use Doitcloud\EmailService\Builders\HereDocTemplates;

class EmailTemplateBuilder
{
    protected string $type = '';
    protected array $content = [];
    protected array $notices = [];
    protected array $footer = [];

    /**
     * Set template type as verification code.
     */
    public function verificationCodeIs(): self
    {
        $this->type = 'verification_code';
        return $this;
    }

    /**
     * Set template type as reset password.
     */
    public function resetPasswordIs(): self
    {
        $this->type = 'reset_password';
        return $this;
    }

    /**
     * Accepts structured content arrays.
     */
    public function content(array $main, array $notices = [], array $footer = []): self
    {
        $this->content = $main;
        $this->notices = $notices;
        $this->footer = $footer;
        return $this;
    }

    /**
     * Generate the final HTML (simplified example).
     */
    public function generate(): string
    {
        switch ($this->type) {
            case 'verification_code':

                $title = $this->content['title'] ?? '';
                $verificationCode = $this->content['verificationCode'] ?? '';
                $text1 = $this->content['text1'] ?? '';

                $notice = $this->notices['notice'] ?? '';

                $footer = $this->footer['footer'] ?? [];
                $link1 = $footer['link1'] ?? '';
                $link2 = $footer['link2'] ?? '';
                $link3 = $footer['link3'] ?? '';
                $text2 = $footer['text2'] ?? '';
                $text3 = $footer['text3'] ?? '';


                return (new HereDocTemplates())->verificationCode($title, $verificationCode, $text1, $notice, $link1, $link2, $link3, $text2, $text3);
                break;
            case 'reset_password':

                $title = $this->content['title'] ?? '';
                $verificationCode = $this->content['verificationCode'] ?? '';
                $text1 = $this->content['text1'] ?? '';

                $notice = $this->notices['notice'] ?? '';

                $footer = $this->footer['footer'] ?? [];
                $link1 = $footer['link1'] ?? '';
                $link2 = $footer['link2'] ?? '';
                $link3 = $footer['link3'] ?? '';
                $text2 = $footer['text2'] ?? '';
                $text3 = $footer['text3'] ?? '';

                return (new HereDocTemplates())->resetPassword($title, $verificationCode, $text1, $notice, $link1, $link2, $link3, $text2, $text3);
                break;
            default:
                return 'Template not found';
                break;
        }
    }
}
