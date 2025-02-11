<?php

function card($item)
{
    echo "
    <div class='bg-background-secondary/30 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl overflow-hidden reveal active'>
        <div class='relative h-48 overflow-hidden'>
            <img
            src='{$item['image']}'
            alt='{$item['title']}'
            class='w-full h-full object-cover transition-transform duration-300 hover:scale-110'
            />
        </div>
        <div class='p-6'>
            <h3 class='text-xl font-semibold mb-3 text-primaryC-yellow'>
            {$item['title']}
            </h3>
            <p class='text-gray-300 text-sm leading-relaxed'>
            {$item['description']}
            </p>
        </div>
    </div>
    ";
}
