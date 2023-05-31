<script>
    import { fly } from "svelte/transition";
    import { onMount } from "svelte";
    import { inertia } from "@inertiajs/svelte";
    export let user;
    let show = true;
    onMount(() => {
        console.log("Welcome to About!");
    });
</script>

{#if show}
    <h1 transition:fly={{ x: 200, y: 200 }}>About {user}!!!</h1>
{/if}
<button on:click={() => (show = !show)} class="border border-black p-1 rounded">
    Toggle
</button>

<a use:inertia href="/">Welcome</a>
