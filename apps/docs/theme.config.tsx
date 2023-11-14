import React from "react";
import { DocsThemeConfig} from "nextra-theme-docs";

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
    link: "https://github.com/nextui-org/tailwind-variants",
  },
  chat: {
    link: "https://discord.gg/9b6yyZKmH4",
  },
  footer: {
    component: Footer,
  }
};

export default config;
