<template>
  <div class="w-full">
    <div
      class="absolute top-0 left-0 w-full h-[125vh] sm:h-[225vh] lg:h-[125vh] cover-gradient-2 sm:cover-gradient"
    ></div>
    <!-- Hero section -->
    <section id="hero" class="w-full pb-24">
      <BaseSection>
        <div class="col-span-12 lg:col-span-6 mt-12 xl:mt-10 space-y-4 sm:space-y-6 px-6 text-center sm:text-left">
          <span data-aos="fade-right" data-aos-once="true" class="text-base text-gradient font-semibold uppercase">
          </span>
          <h1
            data-aos="fade-right"
            data-aos-once="true"
            class="text-[2.5rem] sm:text-5xl xl:text-6xl font-bold leading-tight sm:pr-8 xl:pr-10"
          >
            <span class="text-header-gradient">Svi učimo zajedno</span> kroz naše knjige za decu i odrasle
          </h1>
          <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="paragraph hidden sm:block">
            Uplovite u svet mašte uz naše personalizovane knjige. Vaše dete će biti srećno i zadovoljno!
          </p>
          <div
            data-aos="fade-up"
            data-aos-once="true"
            data-aos-delay="700"
            class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-2"
          >
            <BaseButton
              class="max-w-full px-8 py-4 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] border border-[#0c66ee] text-white shadow-md hover:shadow-xl active:scale-90 transition duration-150"
            >
              Pogledaj knjige <span aria-hidden="true">→</span>
            </BaseButton>
          </div>
        </div>
        <div class="hidden sm:block col-span-12 lg:col-span-6">
          <div class="w-full">
            <img
              data-aos="fade-up"
              data-aos-once="true"
              :src="require('~/assets/img/hero.png')"
              class="-mt-4 pt-8"
              alt=""
            />
          </div>
        </div>
      </BaseSection>
    </section>

   <Tasks />

    <!-- Value proposition section -->
    <section class="w-full my-24">
      <BaseSection>
        <div data-aos="fade-right" class="col-span-12 lg:col-span-6 mt-4 xl:mt-20 space-y-6 px-4">
          <h2 class="text-xl font-semibold sm:pr-8 xl:pr-12">Zašto Radoznali vrabac?</h2>
          <h1 class="text-3xl font-semibold sm:pr-8 xl:pr-12">
            Ekipu Radoznalog vrapca je ujedinila zajednička vizija - želimo da inspirišemo maštu kod naših najmlađih.
            <br class="hidden sm:block" />
            <p class="text-header-gradient mt-5">Neka deca zavole čitanje.</p>
          </h1>
          <p class="paragraph text-justify">
            Vi, kao roditelj, od malih nogu navikavate svoje dete da je čitanje knjiga nešto što je interesantno i
            poučno. Kroz različite tematske knjige, u kojima su prilagođene ilustracije i rečnik svakom uzrastu, želimo
            i da širimo znanja o različitim temama. Deca koja odrastaju uz knjige Radoznalog vrapca će izgraditi ljubav
            prema knjigama i čitanju, što u današnjem svetu svakako nedostaje. Neka deca budu otvorenija za ključne
            poruke koje treba da upiju - radoznalost, dobrota, hrabrost, drugarstvo.
          </p>
        </div>
        <div class="col-span-12 lg:col-span-6">
          <div class="w-full">
            <img
              :src="require('~/assets/img/value-proposition.png')"
              class="mt-4 sm:-mt-4 rounded-2xl"
              alt="Radoznali Vrabac Value Image"
            />
          </div>
        </div>
      </BaseSection>
    </section>

    <div class="w-full my-10 flex justify-center">
      <a
        v-smooth-scroll
        data-aos="flip-down"
        data-aos-delay="150"
        href="#navbar"
        class="px-6 py-3 row-v space-x-2 bg-[#FAFAFA] hover:bg-gray-100 hover:shadow-md border border-[#DDDDDD] rounded-md text-gray-700 shadow-lg"
      >
        <span>Vrati se na vrh</span>
        <ArrowUpIcon :size="20" />
      </a>
    </div>
  </div>
</template>

<script>
import Tasks from '../components/base/Tasks.vue'
import aosMixin from '@/mixins/aos'

export default {
  name: 'IndexPage',
  components: { Tasks },
  mixins: [aosMixin],
  data() {
    return {
      selected: 0,
      dropdownConcurency: false,
    }
  },
  methods: {
    fetchData() {
      // Use Axios to make an API request
    },
  },
}
</script>
<style scoped>
.max-h-0 {
  max-height: 0;
}
</style>
