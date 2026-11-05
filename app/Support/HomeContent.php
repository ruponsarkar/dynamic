<?php

namespace App\Support;

/**
 * Homepage mission and vision text, editable from the admin panel.
 */
class HomeContent
{
    public const DEFAULTS = [
        'home_purpose_heading' => 'Research deserves a clear path to the world.',
        'home_purpose_intro' => 'We connect rigorous scholarship with the readers, practitioners, and communities who can put it to use.',
        'home_mission_title' => 'Make quality research easier to share.',
        'home_mission_text' => 'Our mission is to provide academicians, researchers, and scholars with up-to-date information on discoveries, developments, and ongoing activities in the fields of science and technology. We aim to make this information easily accessible, enabling individuals in these domains to stay informed effortlessly.',
        'home_vision_title' => 'Build trust through open scholarship.',
        'home_vision_text' => 'Our vision is to uphold the highest standards of quality in the publication of research and review articles. We are deeply committed to the timely and effective dissemination of peer-reviewed, top-quality work. To achieve this, we have assembled a team of esteemed editorial members representing diverse disciplines and specializations. Their dedication ensures an efficient and constructive review process that aligns with international research publishing standards.',
    ];

    public static function all(): array
    {
        $content = [];

        foreach (self::DEFAULTS as $key => $default) {
            $content[$key] = SiteSettings::get($key, $default);
        }

        return $content;
    }
}
