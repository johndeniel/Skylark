import React from "react";
import { DocsThemeConfig} from "nextra-theme-docs";
import { useRouter } from 'next/router'
import { tvs, Logo} from "@components";

import { Footer } from "@components/footer/footer";

const DEFAULT_VERSION = "0.1.14";


const config: DocsThemeConfig = {
  darkMode: true,
  nextThemes: {
    defaultTheme: "dark",
  },
  logo: (
    <div className="flex items-center">
      <Logo height={30} />
      <b className="ml-1.5 hidden text-sm font-semibold sm:block sm:text-base">
        Skylark Docs
      </b>
      <span className={tvs.badge({ class: "hidden sm:flex" })}>
        v{DEFAULT_VERSION}
      </span>
    </div>
  ),
  project: {
    link: "https://github.com/johndeniel",
  },
  chat: {
    link: "https://discord.com",
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
        titleTemplate: '%s – Skylark Docs'
      }
    }
  },
  head: (
    <>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="og:title" content="Skylark"/>
    </>
  ),
  footer: {
    component: Footer,
  }
};

export default config;
