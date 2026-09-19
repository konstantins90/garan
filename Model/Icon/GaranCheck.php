<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Icon;

/**
 * Check mark of the GARAN word mark.
 *
 * The path data uses the coordinates of the official artwork (canvas 269.29 x 283.46),
 * so the fragment can be placed into the label without any transform.
 */
class GaranCheck
{
    private const TICK_SHORT = 'M194.13,43.87s-1.05,1.2-1.41,1.58c-.25.26-.57.73-.96.93-1.02.52-1.22.5-2.24.24-.43'
        . '-.11-.83-.43-1.16-.73l-6.81-6.08c-.82-.74-.27-2.1.83-2.06l4.27.16c.52.02,1.02.23,1.4.58l6.09,5.36Z';

    private const TICK_LONG = 'M186.62,44.36l2.04,1.82c1.19.84,2.62.87,3.66-.28l12.06-13.48c.69-.78.19-2.02-.88'
        . '-2.14l-2.02-.24c-.92-.11-1.83.22-2.44.88l-12.42,13.45Z';

    /**
     * Check mark in artwork coordinates, ready to be dropped into the label canvas.
     */
    public function renderFragment(string $disc = '#000000', string $tick = '#ffffff'): string
    {
        $disc = $this->color($disc);
        $tick = $this->color($tick);
        $stroke = ' stroke="#231f20" stroke-width=".5" stroke-miterlimit="10"';

        return '<circle cx="189.45" cy="38.34" r="9.18" fill="' . $disc . '"/>'
            . '<path fill="' . $tick . '"' . $stroke . ' d="' . self::TICK_SHORT . '"/>'
            . '<path fill="' . $tick . '"' . $stroke . ' d="' . self::TICK_LONG . '"/>';
    }

    /**
     * Standalone check mark, scalable via CSS.
     */
    public function render(string $disc = '#000000', string $tick = '#ffffff'): string
    {
        return '<svg class="garant-check-mark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25.2 18.7"'
            . ' aria-hidden="true" focusable="false">'
            . '<g transform="translate(-180.2 -29.05)">' . $this->renderFragment($disc, $tick) . '</g>'
            . '</svg>';
    }

    private function color(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
