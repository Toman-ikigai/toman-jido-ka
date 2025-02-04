<?php

function serviceArea($service)
{
    echo " <div
        class='group relative overflow-hidden rounded-2xl bg-primaryC-black transition-all hover:shadow-xl'
        >
        <div class='aspect-square w-full overflow-hidden'>
            <img
                src='{$service['icon']}'
                alt='{$service['title']}'
            class='h-full w-full object-cover transition-transform duration-500 group-hover:scale-110'
            />
            <div
            class='absolute inset-x-0 bottom-0 h-full bg-gradient-to-t from-primaryC-black/95 to-transparent'
            >
            </div>
        </div>
        <div class='absolute bottom-0 p-6 text-neutralC-white h-32 transition-[height] duration-500 ease-in-out group-hover:h-52'>
            <h3
            class='mb-2 text-xl font-bold text-white transition-all duration-700 ease-in-out transform translate-y-0 group-hover:-translate-y-2'
            >
            {$service['title']}
            </h3>
            <p
            class='opacity-0 transform translate-y-4 transition-all duration-700 ease-in-out group-hover:opacity-100 group-hover:translate-y-0 text-white'
            >
            {$service['description']}
            </p>
        </div>
        </div>";
}
