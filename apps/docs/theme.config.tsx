import React from 'react'
import { useRouter } from 'next/router'
import { DocsThemeConfig } from 'nextra-theme-docs'
import  { Footer } from  './src/components/footer/Footer'

const config: DocsThemeConfig = {
  logo: <span>Skylark</span>,
  project: {
    link: 'https://github.com/shuding/nextra-docs-template',
  },
  banner: {
    key: 'banner',
    text: (
      <a href="https://www.johndeniel.com/">
        🎉 John Deniel 1.0 is released. Read more →
      </a>
    )
  },
  useNextSeoProps() {
    const { route } = useRouter()
    if (route !== '/') {
      return {
        titleTemplate: '%s – Skylark'
      }
    }
  },
  head: (
    <>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="og:title" content="Skylark"/>
    </>
  ),
  docsRepositoryBase: 'https://github.com/shuding/nextra-docs-template',
  footer: {
    component: Footer,
  },
}

export default config