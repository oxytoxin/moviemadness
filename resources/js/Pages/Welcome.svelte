<script>
    import { fade } from "svelte/transition";
    import { inertia } from "@inertiajs/svelte";
    export let user;
    export let errors;
    let show = true;
    console.log(errors);
</script>

{#if show}
    <h1 transition:fade>Hello {user}!!!</h1>
{/if}
<button on:click={() => (show = !show)} class="border border-black p-1 rounded">
    Toggle
</button>

<a use:inertia href="/about">About</a>
