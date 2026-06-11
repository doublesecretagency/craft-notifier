<script setup>
// Wraps the default theme's Layout to swap in a custom 404 recovery page.
// Only the `not-found` slot is overridden; nav, footer, sidebar, and search
// all stay default.

import DefaultTheme from 'vitepress/theme'
import NotFound from './components/NotFound.vue'

const { Layout } = DefaultTheme
</script>

<template>
  <Layout>
    <template #not-found>
      <NotFound />
    </template>
  </Layout>
</template>
