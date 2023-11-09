<template>
  <nav id="navbar" class="relative z-10 w-full text-neutral-800">
    <div class="flex flex-col max-w-screen-xl px-8 mx-auto lg:items-center lg:justify-between lg:flex-row">
      <div class="col-h lg:flex-row space-x-4 xl:space-x-8">
        <div class="w-full row-v justify-between pt-0">
          <a href="/">
            <div>
              <img
                :src="require('~/assets/img/logo/logo_sideways_primary.png')"
                href="./"
                class="w-40 xl:w-44"
                alt="Radoznali Vrabac Logo"
              />
            </div>
          </a>
          <button class="rounded-lg lg:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
            <SegmentIcon v-if="!open" :size="24" />
            <CloseIcon v-else :size="24" />
          </button>
        </div>
        <ul
          :class="[open ? 'flex' : 'hidden lg:flex']"
          class="w-full h-auto flex flex-col flex-grow lg:items-center pt:4 pb-4 lg:pt-0 lg:pb-0 lg:justify-end lg:flex-row origin-top duration-300 xl:space-x-2 space-y-3 lg:space-y-0"
        >
          <li class="product group">
            <button
              class="md:px-4 py-2 text-sm bg-transparent rounded-lg text-[#2c2929] hover:text-gray-900 focus:outline-none focus:shadow-outline row-v"
              @click="dropdownToggler('products')"
              @blur="dropdownToggler('products')"
            >
              <span>Knjige</span>
              <ChevronUpIcon v-if="dropdownProducts" :size="16" />
              <ChevronDownIcon v-else :size="16" />
            </button>
            <transition name="transform-fade-down">
              <ul
                v-if="dropdownProducts"
                class="absolute text-sm bg-white rounded-md lg:shadow-md grid w-auto lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 lg:absolute"
              >
                <div v-for="(item, index) in productItems" :key="index">
                  <li class="w-full h-full flex">
                    <a
                      :href="item.route"
                      class="block py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 row-v space-x-2"
                    >
                      <div class="pl-1">
                        {{ item.title }}
                      </div>
                    </a>
                  </li>
                </div>
              </ul>
            </transition>
          </li>
          <NavLink name="Utisci" class="utisci" url="/utisci" />
          <li class="docs group navbar-resources">
            <button
              class="md:px-4 py-2 text-sm bg-transparent rounded-lg text-[#666666] hover:text-gray-900 focus:outline-none focus:shadow-outline row-v min-w-[10rem]"
              @click="dropdownToggler('resources')"
              @blur="dropdownToggler('resources')"
            >
              <span>Učimo zajedno</span>
              <ChevronUpIcon v-if="dropdownResources" :size="16" />
              <ChevronDownIcon v-else :size="16" />
            </button>
            <transition name="transform-fade-down">
              <ul
                v-if="dropdownResources"
                class="flex lg:absolute flex-col max-w-42 py-1 lg:bg-white rounded-md lg:shadow-md pl-2 lg:pl-0"
              >
                <div v-for="(item, index) in resourceItems" :key="index">
                  <li class="w-full h-full flex">
                    <a
                      :href="item.route"
                      class="block py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 row-h space-x-2"
                    >
                      <div class="pl-1">
                        {{ item.title }}
                      </div>
                    </a>
                  </li>
                </div>
              </ul>
            </transition>
          </li>
          <NavLink name="Kontakt" class="kontakt" url="/kontakt" />
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { productItems, resourceItems } from '~~/constants/iconPaths'
export default {
  name: 'BaseNavbar',
  data() {
    return {
      open: false,
      dropdownProducts: false,
      dropdownResources: false,
      productItems,
      resourceItems
    }
  },
  methods: {
    dropdownToggler(dropdownName) {
      if (dropdownName === 'products') {
        this.dropdownResources = false
        this.dropdownProducts = !this.dropdownProducts
      } else if (dropdownName === 'resources') {
        this.dropdownProducts = false
        this.dropdownResources = !this.dropdownResources
      }
    }
  }
}
</script>

<style>
.auth-btn-sm {
  margin-top: 1rem !important;
}
@media screen and (max-width: 1024px) {
  .navbar-pricing {
    margin-top: 1rem !important;
  }
  .kontakt {
    margin-bottom: 0.5rem !important;
  }
}
</style>
