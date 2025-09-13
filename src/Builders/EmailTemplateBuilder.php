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
     * Set template type as reset password.
     */
    public function newUserIs(): self
    {
        $this->type = 'new_user';
        return $this;
    }

    public function FlightStatusIs(): self
    {
        $this->type = 'flight_status';
        return $this;
    }

    /**
     * Set template type as usage report.
     */
    public function usageReportIs(): self
    {
        $this->type = 'usage_report';
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
                $resetLink = $this->content['resetLink'] ?? '';
                $text1 = $this->content['text1'] ?? '';

                $notice = $this->notices['notice'] ?? '';

                $footer = $this->footer['footer'] ?? [];
                $link1 = $footer['link1'] ?? '';
                $link2 = $footer['link2'] ?? '';
                $link3 = $footer['link3'] ?? '';
                $text2 = $footer['text2'] ?? '';
                $text3 = $footer['text3'] ?? '';

                return (new HereDocTemplates())->resetPassword($title, $resetLink, $text1, $notice, $link1, $link2, $link3, $text2, $text3);
                break;
            case 'new_user':
                $text1 = $this->content['title'] ?? '';
                $text2 = $this->content['newUser'] ?? '';
                $text3 = $this->content['description'] ?? '';

                $text4 = $this->notices['detail'] ?? '';
                $url   = $this->notices['url'] ?? '';
                $text5 = $this->notices['field'] ?? '';
                $email = $this->notices['email'] ?? '';
                $text6 = $this->notices['instructions'] ?? '';
                $text7 = $this->notices['question'] ?? '';
                $text8 = $this->notices['answer'] ?? '';
                $text9 = $this->notices['news'] ?? '';
                $text10 = $this->notices['experience'] ?? '';
                $text11 = $this->notices['policies'] ?? '';

                $footer = $this->footer['footer'] ?? [];
                $text12 = $this->footer['lastInstructionWhite'] ?? '';
                $text13 = $this->footer['lastInstructionGrey'] ?? '';

                return (new HereDocTemplates())->newUserCreated($text1, $text2, $text3, $text4, $text5, $email, $text6, $text7, $text8, $text9, $text10, $text11, $text12, $text13, $url);
                break;

            case 'usage_report':
                $greeting = $this->content['greeting'] ?? '';
                $bodyText = $this->content['bodyText'] ?? '';
                $footer = $this->footer['footer'] ?? [];
                $footerSocialLinks = $footer['socialLinks'] ?? [];
                $footerTitle = $footer['title'] ?? '';
                $footerSubtitle = $footer['subtitle'] ?? '';
                $footerLinkManage = $footer['linkManage'] ?? '';
                $footerLinkExperience = $footer['linkExperience'] ?? '';
                $footerLinkPolicies = $footer['linkPolicies'] ?? '';
                $footerSearchButton = $footer['searchButton'] ?? '';
                $footerContact = $footer['contact'] ?? '';

                return ((new HereDocTemplates())->usageReport(
                    $greeting,
                    $bodyText,
                    $footerSocialLinks,
                    $footerTitle,
                    $footerSubtitle,
                    $footerLinkManage,
                    $footerLinkExperience,
                    $footerLinkPolicies,
                    $footerSearchButton,
                    $footerContact
                ));
                break;



            default:
                return 'Template not found';
                break;
        }
    }
}
