import pkg from './package'
require('dotenv').config()

export default {
  mode: 'universal',
  srcDir: './nuxtjs',

  /*
  ** Headers of the page
  */
  head: {
    title: pkg.name,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: pkg.description }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },

  /*
  ** Global CSS
  */
  css: [
  ],

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/proxy',
    '@nuxtjs/dotenv',
    'bootstrap-vue/nuxt',
  ],

  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {
    }
  },

  proxy: {
    '/api': process.env.FRONT_APP_ENV === 'dev' ? 'http://localhost:8000' : '',
  },

  router: {
    base: process.env.FRONT_APP_ENV === 'dev' ? '/' : '/gour-me/',
  },

  env: {
    FRONT_APP_ENV: process.env.FRONT_APP_ENV,
  },

}
