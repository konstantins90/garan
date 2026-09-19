<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Label;

use Smetana\Garant\Model\Icon\EuShield;
use Smetana\Garant\Model\Icon\GaranCheck;

/**
 * Renders the harmonised guarantee label (Annex II) as inline SVG.
 *
 * Every coordinate follows the official artwork on a 269.29 x 283.46 canvas. The upper panel
 * (word mark, guarantee period, manufacturer, model identifier, QR code) is drawn here; the
 * multilingual footer is flowed as text by the template because it has to wrap and justify.
 */
class Artwork
{
    public const PANEL_WIDTH = 269.29;
    public const PANEL_HEIGHT = 171.68;

    private const INK = '#231f20';
    private const FONT = 'Inter, system-ui, -apple-system, Arial, sans-serif';

    private const WORDMARK = 'M30.59,24.41c-.28-.92-.67-1.75-1.17-2.48-.49-.73-1.09-1.36-1.77-1.88s-1.47-.92-2.36'
        . '-1.18-1.85-.4-2.9-.4c-1.88,0-3.55.47-5.01,1.41-1.47.94-2.62,2.33-3.45,4.15-.83,1.82-1.25,4.04-1.25,6.66s'
        . '.42,4.87,1.24,6.7c.83,1.83,1.98,3.22,3.46,4.17s3.19,1.42,5.15,1.42c1.77,0,3.31-.34,4.61-1.02,1.3-.68,2.3'
        . '-1.65,3.01-2.91s1.06-2.73,1.06-4.42l1.43.22h-9.48v-4.94h14.16v4.19c0,2.99-.64,5.57-1.91,7.75-1.27,2.18'
        . '-3.02,3.86-5.25,5.04-2.23,1.18-4.78,1.76-7.67,1.76-3.22,0-6.04-.72-8.46-2.17-2.43-1.45-4.32-3.51-5.68'
        . '-6.19-1.36-2.68-2.04-5.85-2.04-9.54,0-2.82.4-5.33,1.2-7.55.8-2.22,1.92-4.1,3.37-5.65,1.44-1.55,3.14-2.73,'
        . '5.08-3.55,1.94-.81,4.06-1.22,6.34-1.22,1.93,0,3.73.28,5.4.84s3.16,1.36,4.46,2.4,2.37,2.26,3.21,3.68,1.39,'
        . '2.99,1.65,4.7h-6.44Z'
        . 'M47.31,48.17h-6.75l12.29-34.91h7.81l12.31,34.91h-6.75l-9.32-27.75h-.27l-9.31,27.75ZM47.54,34.48h18.41v'
        . '5.08h-18.41v-5.08Z'
        . 'M78.05,48.17V13.26h13.09c2.68,0,4.93.47,6.76,1.4,1.82.93,3.2,2.24,4.14,3.91.94,1.68,1.41,3.63,1.41,5.86s'
        . '-.47,4.18-1.42,5.82c-.95,1.64-2.34,2.91-4.18,3.8-1.84.89-4.1,1.34-6.78,1.34h-9.32v-5.25h8.47c1.57,0,2.85'
        . '-.22,3.85-.66s1.74-1.08,2.22-1.93c.48-.85.72-1.89.72-3.13s-.24-2.3-.73-3.18c-.49-.88-1.23-1.55-2.23-2.01s'
        . '-2.29-.69-3.87-.69h-5.8v29.62h-6.32ZM96.08,32.35l8.64,15.82h-7.06l-8.49-15.82h6.9Z'
        . 'M114.24,48.17h-6.75l12.29-34.91h7.81l12.31,34.91h-6.75l-9.32-27.75h-.27l-9.31,27.75ZM114.46,34.48h18.41v'
        . '5.08h-18.41v-5.08Z'
        . 'M173.66,13.26v34.91h-5.62l-16.45-23.78h-.29v23.78h-6.32V13.26h5.66l16.43,23.8h.31V13.26h6.29Z';

    private const CALENDAR_DIGITS = 'M126.94,146.61c-.64,0-1.2-.11-1.69-.33-.49-.22-.88-.52-1.16-.91-.28-.39-.43'
        . '-.83-.43-1.33h2.03c0,.18.07.34.18.48.11.14.26.25.44.33.19.08.4.12.64.12s.45-.04.63-.13.33-.2.43-.35c.1'
        . '-.15.15-.32.15-.52,0-.2-.05-.37-.17-.52-.11-.15-.28-.27-.48-.35s-.45-.13-.74-.13h-.81v-1.43h.81c.25,0,'
        . '.46-.04.65-.12s.34-.2.44-.34.16-.32.15-.51c0-.19-.04-.35-.13-.5s-.22-.25-.38-.33c-.16-.08-.35-.12-.56'
        . '-.12-.22,0-.42.04-.6.12-.18.08-.32.19-.43.33-.11.14-.16.31-.17.5h-1.93c0-.5.14-.93.42-1.31.27-.38.64-.68,'
        . '1.11-.89.47-.21,1-.32,1.6-.32s1.12.11,1.58.31.81.49,1.06.85c.25.36.38.77.38,1.22,0,.47-.15.86-.46,1.16'
        . '-.31.3-.7.49-1.19.56v.07c.65.08,1.13.28,1.46.63s.49.77.49,1.28c0,.48-.14.91-.42,1.29-.28.37-.68.67-1.18'
        . '.88-.5.21-1.08.32-1.73.32Z'
        . 'M134.75,146.61c-.46,0-.89-.07-1.31-.22-.42-.15-.79-.38-1.12-.71s-.58-.75-.77-1.28c-.19-.53-.28-1.17-.28'
        . '-1.93,0-.69.09-1.3.25-1.85.17-.55.4-1.01.71-1.4.31-.38.68-.68,1.11-.88.43-.2.91-.3,1.44-.3.58,0,1.1.11,'
        . '1.55.34s.8.53,1.07.91c.27.38.43.81.48,1.27h-1.98c-.06-.26-.19-.46-.39-.6-.2-.14-.44-.21-.72-.21-.51,0'
        . '-.89.22-1.14.66-.25.44-.38,1.03-.38,1.78h.05c.11-.25.28-.46.49-.64s.46-.32.74-.41c.28-.1.57-.15.89-.15.5,'
        . '0,.94.12,1.32.35.38.23.68.55.9.95s.32.86.32,1.37c0,.58-.13,1.09-.41,1.54s-.65.79-1.14,1.04c-.48.25-1.05'
        . '.37-1.68.37ZM134.74,145.06c.25,0,.47-.06.66-.18s.35-.28.46-.48c.11-.2.17-.43.16-.68,0-.26-.05-.48-.16'
        . '-.68s-.26-.36-.46-.47-.42-.18-.67-.18c-.18,0-.35.03-.51.1-.16.07-.29.16-.41.28s-.21.26-.27.42c-.07.16-.1'
        . '.34-.1.52,0,.25.06.47.17.67.11.2.26.36.46.48.19.12.41.18.66.18Z'
        . 'M142.32,146.61c-.61,0-1.15-.11-1.62-.33-.47-.22-.85-.52-1.12-.91-.27-.39-.41-.83-.42-1.33h1.95c.02.31.14'
        . '.55.37.74s.51.28.83.28c.25,0,.48-.06.67-.17.2-.11.35-.27.46-.47s.17-.44.16-.7c0-.27-.05-.5-.17-.7-.11-.2'
        . '-.27-.36-.46-.47-.2-.11-.42-.17-.68-.17-.24,0-.47.05-.69.16-.22.11-.38.26-.49.44l-1.78-.33.36-4.5h5.35v'
        . '1.62h-3.69l-.19,1.97h.05c.14-.23.36-.42.67-.57s.66-.23,1.05-.23c.5,0,.95.12,1.34.35.39.23.7.55.93.96s.34'
        . '.88.34,1.41c0,.57-.13,1.08-.41,1.52-.27.44-.65.79-1.13,1.04s-1.05.38-1.7.38Z';

    public function __construct(
        private readonly EuShield $euShield,
        private readonly GaranCheck $garanCheck
    ) {
    }

    /**
     * Upper panel of the label: word mark, guarantee period, manufacturer, model identifier, QR code.
     */
    public function renderPanel(LabelData $data, string $qrSvg = '', string $qrUrl = ''): string
    {
        return '<svg class="garant-label__art" xmlns="http://www.w3.org/2000/svg"'
            . ' viewBox="0 0 ' . self::PANEL_WIDTH . ' ' . self::PANEL_HEIGHT . '">'
            . '<rect fill="#ffffff" width="' . self::PANEL_WIDTH . '" height="' . self::PANEL_HEIGHT . '"/>'
            . '<rect fill="none" stroke="' . self::INK . '" stroke-width=".5" stroke-miterlimit="10"'
            . ' x="3.09" y="2.63" width="263.11" height="165.38"/>'
            . $this->text($data->getBrand(), 'translate(6.32 74.52)', 9)
            . $this->text($data->getModelId(), 'translate(262.95 74.52)', 9, 'end')
            . '<line fill="none" stroke="' . self::INK . '" stroke-miterlimit="10"'
            . ' x1="6.32" y1="61.34" x2="262.97" y2="61.34"/>'
            . $this->euShield->renderFragment()
            . '<g fill="' . self::INK . '"><path d="' . self::WORDMARK . '"/></g>'
            . $this->qrCode($qrSvg, $qrUrl)
            . $this->garanCheck->renderFragment()
            . $this->text($data->getDurationDisplay(), 'translate(108.8 150.57)', 80, 'end', 800, '-.03em')
            . $this->calendar()
            . '</svg>';
    }

    /**
     * Nested (compact) format of Annex II: guarantee period plus the GARAN word mark.
     */
    public function renderBadge(LabelData $data): string
    {
        // The period is set right aligned, so a single digit would leave a gap
        // in front of it: the whole row then moves to the left edge.
        $gap = strlen($data->getDurationDisplay()) > 1 ? 0 : 17;
        $x = static fn (float $base): string => (string)($base - $gap);

        return '<svg class="garant-badge__art" xmlns="http://www.w3.org/2000/svg"'
            . ' viewBox="0 0 ' . (234 - $gap) . ' 46">'
            . $this->text($data->getDurationDisplay(), 'translate(' . $x(46) . ' 37)', 38, 'end', 800, '-.03em')
            . '<g transform="translate(' . $x(52) . ' 12) scale(.78) translate(-121.47 -124.74)">'
            . $this->calendar() . '</g>'
            . '<line fill="none" stroke="' . self::INK . '" stroke-width="1.1"'
            . ' x1="' . $x(79) . '" y1="9" x2="' . $x(79) . '" y2="37"/>'
            . '<g transform="translate(' . $x(88) . ' 14) scale(.55)"><g fill="' . self::INK . '"'
            . ' transform="translate(-8.3 -12.4)"><path d="' . self::WORDMARK . '"/></g></g>'
            . '<g transform="translate(' . $x(182) . ' 20) scale(.62)"><g transform="translate(-180.2 -29.05)">'
            . $this->garanCheck->renderFragment() . '</g></g>'
            . '<g transform="translate(' . $x(202) . ' 4) scale(.8)"><g transform="translate(-229.14 0)">'
            . $this->euShield->renderFragment() . '</g></g>'
            . '</svg>';
    }

    private function calendar(): string
    {
        return '<g>'
            . '<rect fill="none" stroke="' . self::INK . '" stroke-width=".5" stroke-miterlimit="10"'
            . ' x="121.47" y="127.8" width="26.36" height="22.68" rx="1.66" ry="1.66"/>'
            . '<rect fill="#ffffff" stroke="' . self::INK . '" stroke-width=".5" stroke-miterlimit="10"'
            . ' x="128.31" y="124.74" width="3.13" height="6.19" rx=".54" ry=".54"/>'
            . '<rect fill="#ffffff" stroke="' . self::INK . '" stroke-width=".5" stroke-miterlimit="10"'
            . ' x="137.85" y="124.74" width="3.13" height="6.19" rx=".54" ry=".54"/>'
            . '<line fill="none" stroke="' . self::INK . '" stroke-width=".5" stroke-miterlimit="10"'
            . ' x1="121.47" y1="133.96" x2="147.83" y2="133.96"/>'
            . '<g fill="' . self::INK . '"><path d="' . self::CALENDAR_DIGITS . '"/></g>'
            . '</g>';
    }

    private function qrCode(string $qrSvg, string $qrUrl): string
    {
        if ($qrSvg === '') {
            return '';
        }

        $image = '<image x="196.52" y="84.49" width="68.17" height="68.17" href="data:image/svg+xml;base64,'
            . base64_encode($qrSvg) . '"/>';

        if ($qrUrl === '') {
            return $image;
        }

        return '<a href="' . $this->escape($qrUrl) . '" target="_blank" rel="noopener">' . $image . '</a>';
    }

    private function text(
        string $value,
        string $transform,
        float $size,
        string $anchor = 'start',
        int $weight = 400,
        string $tracking = 'normal'
    ): string {
        if ($value === '') {
            return '';
        }

        return '<text fill="' . self::INK . '" font-family="' . self::FONT . '" font-size="' . $size . '"'
            . ' font-weight="' . $weight . '" letter-spacing="' . $tracking . '" text-anchor="' . $anchor . '"'
            . ' transform="' . $transform . '"><tspan x="0" y="0">' . $this->escape($value) . '</tspan></text>';
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
