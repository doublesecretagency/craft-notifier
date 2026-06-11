<script setup>
// A top-nav menu that adds a third tier (category -> pages) on top of the
// default theme's two-level dropdown. Desktop renders a cascade flyout
// (hover a category to reveal its pages); mobile renders a nested accordion.
// Wired in via a `{ component: 'NestedNavMenu', props: {...} }` nav item, so
// VitePress passes `screen-menu` automatically inside the mobile nav screen.

import { ref, computed, watch, onMounted, onBeforeUnmount, inject, nextTick } from 'vue'
import { useData, useRoute, withBase } from 'vitepress'

const props = defineProps({
  // Nav button label
  text: { type: String, default: '' },
  // Mixed list: plain links {text, link} and category groups {text, items:[{text, link}]}
  items: { type: Array, default: () => [] },
  // Optional regex (string) to mark the nav button active
  activeMatch: { type: String, default: '' },
  // Set true by VitePress when rendered inside the mobile nav screen
  screenMenu: { type: Boolean, default: false },
})

const { page } = useData()
const route = useRoute()

// Whether an item is a category group (has nested items) vs a plain link
const isGroup = (item) => Array.isArray(item.items)

// Normalize a path for comparison (strip query/hash, .md/.html, index, trailing slash)
function clean(path) {
  return (
    path
      .replace(/[?#].*$/, '')
      .replace(/(?:index)?\.(?:md|html)$/i, '')
      .replace(/\/$/, '') || '/'
  )
}

// Whether a link points at the current page
function linkActive(link) {
  if (!link) {
    return false
  }
  return clean('/' + page.value.relativePath) === clean(link)
}

// Whether any descendant link is active
function groupHasActive(items) {
  return items.some((it) =>
    isGroup(it) ? groupHasActive(it.items) : linkActive(it.link)
  )
}

// Whether the nav button should read as active
const navActive = computed(() => {
  if (props.activeMatch) {
    try {
      return new RegExp(props.activeMatch).test('/' + page.value.relativePath)
    } catch {
      return false
    }
  }
  return groupHasActive(props.items)
})

// ========================================================================= //
// Desktop flyout state
// ========================================================================= //

const root = ref(null)
const open = ref(false)
const openCat = ref(-1)
// Whether the active category's flyout opens leftward (set by measurement)
const openLeft = ref(false)
let closeTimer

function show() {
  clearTimeout(closeTimer)
  open.value = true
}

// Open a category and pick its flyout direction by measuring viewport space
async function openCategory(i, e) {
  openCat.value = i
  // Wait for the flyout to render so we can measure its width
  await nextTick()
  // Get the category wrapper (from the hovered wrap or the clicked button)
  const wrap = e.currentTarget.closest('.NNM-cat-wrap')
  // If the wrapper is gone, bail
  if (!wrap) {
    return
  }
  // Get the flyout panel
  const sub = wrap.querySelector('.NNM-sub')
  // If no flyout, bail
  if (!sub) {
    return
  }
  // Open left only when the flyout wouldn't fit to the right
  const margin = 16
  const rightSpace = window.innerWidth - wrap.getBoundingClientRect().right
  openLeft.value = rightSpace < sub.offsetWidth + margin
}

function scheduleHide() {
  closeTimer = setTimeout(() => {
    open.value = false
    openCat.value = -1
  }, 120)
}

function toggle() {
  if (open.value) {
    open.value = false
    openCat.value = -1
  } else {
    open.value = true
  }
}

// Close on outside click and on Escape
function onDocClick(e) {
  if (open.value && root.value && !root.value.contains(e.target)) {
    open.value = false
    openCat.value = -1
  }
}

function onKeydown(e) {
  if (e.key === 'Escape') {
    open.value = false
    openCat.value = -1
  }
}

onMounted(() => {
  document.addEventListener('click', onDocClick)
  document.addEventListener('keydown', onKeydown)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', onDocClick)
  document.removeEventListener('keydown', onKeydown)
})

// ========================================================================= //
// Mobile accordion state
// ========================================================================= //

const screenOpen = ref(false)
const openScreenCats = ref({})
const closeScreen = inject('close-screen', () => {})

function toggleScreen() {
  screenOpen.value = !screenOpen.value
}

function toggleScreenCat(i) {
  openScreenCats.value = { ...openScreenCats.value, [i]: !openScreenCats.value[i] }
}

// Reset all open state on navigation
watch(
  () => route.path,
  () => {
    open.value = false
    openCat.value = -1
    screenOpen.value = false
    openScreenCats.value = {}
  }
)
</script>

<template>
  <!-- Desktop: cascade flyout -->
  <div
    v-if="!screenMenu"
    ref="root"
    class="NNM"
    :class="{ active: navActive }"
    @mouseenter="show"
    @mouseleave="scheduleHide"
  >
    <button
      type="button"
      class="NNM-button"
      aria-haspopup="true"
      :aria-expanded="open"
      @click="toggle"
    >
      <span class="NNM-text">
        <span v-html="text" />
        <span class="vpi-chevron-down NNM-caret" />
      </span>
    </button>

    <div class="NNM-menu" :class="{ shown: open }">
      <div class="NNM-items">
        <template v-for="(item, i) in items" :key="i">
          <hr v-if="item.divider" class="NNM-divider" />

          <a
            v-else-if="!isGroup(item)"
            class="NNM-link"
            :class="{ active: linkActive(item.link) }"
            :href="withBase(item.link)"
          >
            <span v-html="item.text" />
          </a>

          <div
            v-else
            class="NNM-cat-wrap"
            @mouseenter="openCategory(i, $event)"
            @mouseleave="openCat = -1"
          >
            <button
              type="button"
              class="NNM-cat"
              :class="{ open: openCat === i }"
              aria-haspopup="true"
              :aria-expanded="openCat === i"
              @click="openCat === i ? (openCat = -1) : openCategory(i, $event)"
            >
              <span class="NNM-cat-label" v-html="item.text" />
              <span
                class="vpi-chevron-right NNM-cat-caret"
                :class="{ 'NNM-cat-caret-left': openCat === i && openLeft }"
              />
            </button>

            <div
              class="NNM-sub"
              :class="{ shown: openCat === i, 'open-left': openLeft }"
            >
              <a
                v-for="(sub, j) in item.items"
                :key="j"
                class="NNM-link"
                :class="{ active: linkActive(sub.link) }"
                :href="withBase(sub.link)"
              >
                <span v-html="sub.text" />
              </a>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>

  <!-- Mobile: nested accordion -->
  <div v-else class="NNM-screen" :class="{ open: screenOpen }">
    <button
      type="button"
      class="NNM-screen-button"
      :aria-expanded="screenOpen"
      @click="toggleScreen"
    >
      <span v-html="text" />
      <span class="vpi-plus NNM-screen-icon" />
    </button>

    <div v-show="screenOpen" class="NNM-screen-items">
      <template v-for="(item, i) in items" :key="i">
        <hr v-if="item.divider" class="NNM-screen-divider" />

        <a
          v-else-if="!isGroup(item)"
          class="NNM-screen-link"
          :href="withBase(item.link)"
          @click="closeScreen"
        >
          <span v-html="item.text" />
        </a>

        <div v-else class="NNM-screen-cat" :class="{ open: openScreenCats[i] }">
          <button
            type="button"
            class="NNM-screen-cat-button"
            :aria-expanded="!!openScreenCats[i]"
            @click="toggleScreenCat(i)"
          >
            <span v-html="item.text" />
            <span class="vpi-chevron-down NNM-screen-cat-icon" />
          </button>

          <div v-show="openScreenCats[i]" class="NNM-screen-sublinks">
            <a
              v-for="(sub, j) in item.items"
              :key="j"
              class="NNM-screen-sublink"
              :href="withBase(sub.link)"
              @click="closeScreen"
            >
              <span v-html="sub.text" />
            </a>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<style scoped>
/* ===== Desktop ===== */

.NNM {
  position: relative;
}

.NNM:hover {
  color: var(--vp-c-brand-1);
  transition: color 0.25s;
}

.NNM-button {
  display: flex;
  align-items: center;
  padding: 0 12px;
  height: var(--vp-nav-height);
  background: transparent;
  color: var(--vp-c-text-1);
  transition: color 0.5s;
}

.NNM-text {
  display: flex;
  align-items: center;
  line-height: var(--vp-nav-height);
  font-size: 14px;
  font-weight: 500;
  color: var(--vp-c-text-1);
  transition: color 0.25s;
}

.NNM:hover .NNM-text {
  color: var(--vp-c-text-2);
}

.NNM.active .NNM-text {
  color: var(--vp-c-brand-1);
}

.NNM.active:hover .NNM-text {
  color: var(--vp-c-brand-2);
}

.NNM-caret {
  margin-left: 4px;
  font-size: 14px;
}

.NNM-menu {
  position: absolute;
  top: calc(var(--vp-nav-height) / 2 + 20px);
  right: 0;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.25s, visibility 0.25s;
}

.NNM-menu.shown {
  opacity: 1;
  visibility: visible;
}

.NNM-items {
  border-radius: 12px;
  padding: 12px;
  min-width: 144px;
  border: 1px solid var(--vp-c-divider);
  background-color: var(--vp-c-bg-elv);
  box-shadow: var(--vp-shadow-3);
  transition: background-color 0.5s;
}

.NNM-link {
  display: block;
  border-radius: 6px;
  padding: 0 12px;
  line-height: 32px;
  font-size: 14px;
  font-weight: 500;
  color: var(--vp-c-text-1);
  white-space: nowrap;
  transition: background-color 0.25s, color 0.25s;
}

.NNM-link:hover {
  color: var(--vp-c-brand-1);
  background-color: var(--vp-c-default-soft);
}

.NNM-link.active {
  color: var(--vp-c-brand-1);
}

/* Edge-to-edge divider between item groups (cancels the 12px box padding) */
.NNM-divider {
  margin: 12px -12px;
  border: none;
  border-top: 1px solid var(--vp-c-divider);
}

/* Category row + cascade submenu */

.NNM-cat-wrap {
  position: relative;
}

.NNM-cat {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  width: 100%;
  border-radius: 6px;
  padding: 0 12px;
  line-height: 32px;
  font-size: 14px;
  font-weight: 500;
  color: var(--vp-c-text-1);
  white-space: nowrap;
  background: transparent;
  transition: background-color 0.25s, color 0.25s;
}

.NNM-cat:hover,
.NNM-cat.open {
  color: var(--vp-c-brand-1);
  background-color: var(--vp-c-default-soft);
}

.NNM-cat-caret {
  flex-shrink: 0;
  font-size: 14px;
  opacity: 0.65;
  transition: transform 0.25s;
}

/* When the flyout opens leftward, point the caret left to match */
.NNM-cat-caret-left {
  /*rtl:ignore*/
  transform: rotate(180deg);
}

/* Opens to the right by default (matches the caret); flips to .open-left when
   the flyout wouldn't fit. Nudged out by --nnm-gap so it only slightly overlaps
   the parent panel; the ::before bridge below keeps hover continuous. */
.NNM-sub {
  --nnm-gap: 6px;
  position: absolute;
  top: -12px;
  left: calc(100% + var(--nnm-gap));
  border-radius: 12px;
  padding: 12px;
  min-width: 144px;
  border: 1px solid var(--vp-c-divider);
  background-color: var(--vp-c-bg-elv);
  box-shadow: var(--vp-shadow-3);
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.25s, visibility 0.25s;
}

.NNM-sub.open-left {
  left: auto;
  right: calc(100% + var(--nnm-gap));
}

/* Transparent bridge across the gap so the cursor never leaves the menu subtree */
.NNM-sub::before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: calc(-1 * var(--nnm-gap));
  width: var(--nnm-gap);
}

.NNM-sub.open-left::before {
  left: auto;
  right: calc(-1 * var(--nnm-gap));
}

.NNM-sub.shown {
  opacity: 1;
  visibility: visible;
}

/* ===== Mobile (screen menu) ===== */

.NNM-screen {
  border-bottom: 1px solid var(--vp-c-divider);
  transition: border-color 0.5s;
}

.NNM-screen.open {
  padding-bottom: 10px;
}

.NNM-screen-button {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 4px 11px 0;
  width: 100%;
  line-height: 24px;
  font-size: 14px;
  font-weight: 500;
  color: var(--vp-c-text-1);
  background: transparent;
  transition: color 0.25s;
}

.NNM-screen-button:hover {
  color: var(--vp-c-brand-1);
}

.NNM-screen.open .NNM-screen-button {
  padding-bottom: 6px;
  color: var(--vp-c-brand-1);
}

.NNM-screen-icon {
  transition: transform 0.25s;
}

.NNM-screen.open .NNM-screen-icon {
  /*rtl:ignore*/
  transform: rotate(45deg);
}

.NNM-screen-link {
  display: block;
  margin-left: 12px;
  line-height: 32px;
  font-size: 14px;
  font-weight: 400;
  color: var(--vp-c-text-1);
  transition: color 0.25s;
}

.NNM-screen-link:hover {
  color: var(--vp-c-brand-1);
}

.NNM-screen-divider {
  margin: 8px 0;
  border: none;
  border-top: 1px solid var(--vp-c-divider);
}

.NNM-screen-cat-button {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-left: 12px;
  padding: 0 4px 0 0;
  width: calc(100% - 12px);
  line-height: 32px;
  font-size: 14px;
  font-weight: 500;
  color: var(--vp-c-text-1);
  background: transparent;
  transition: color 0.25s;
}

.NNM-screen-cat.open .NNM-screen-cat-button {
  color: var(--vp-c-brand-1);
}

.NNM-screen-cat-icon {
  flex-shrink: 0;
  font-size: 14px;
  transition: transform 0.25s;
}

.NNM-screen-cat.open .NNM-screen-cat-icon {
  /*rtl:ignore*/
  transform: rotate(180deg);
}

.NNM-screen-sublink {
  display: block;
  margin-left: 24px;
  line-height: 32px;
  font-size: 14px;
  font-weight: 400;
  color: var(--vp-c-text-1);
  transition: color 0.25s;
}

.NNM-screen-sublink:hover {
  color: var(--vp-c-brand-1);
}
</style>
