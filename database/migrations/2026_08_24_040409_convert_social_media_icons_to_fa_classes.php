<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * @var array<string, string>
     */
    private array $emojiToFaClass = [
        '📘' => 'fa-brands fa-facebook-f',
        '📷' => 'fa-brands fa-instagram',
        '𝕏' => 'fa-brands fa-x-twitter',
        'in' => 'fa-brands fa-linkedin-in',
        '▶' => 'fa-brands fa-youtube',
        '🎵' => 'fa-brands fa-tiktok',
        '💬' => 'fa-brands fa-whatsapp',
        '✈' => 'fa-brands fa-telegram',
        '🧵' => 'fa-brands fa-threads',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->remap($this->emojiToFaClass);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->remap(array_flip($this->emojiToFaClass));
    }

    /**
     * @param  array<string, string>  $map
     */
    private function remap(array $map): void
    {
        DB::table('footer_settings')->orderBy('id')->each(function (object $row) use ($map) {
            $socialMedia = json_decode((string) $row->social_media, true) ?? [];

            foreach ($socialMedia as &$item) {
                if (isset($item['icon'], $map[$item['icon']])) {
                    $item['icon'] = $map[$item['icon']];
                }
            }

            DB::table('footer_settings')->where('id', $row->id)->update([
                'social_media' => json_encode($socialMedia),
            ]);
        });
    }
};
