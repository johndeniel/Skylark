"use client"

import React from "react"
import { MainNav } from "@/components/main-nav"
import { navigationgConfig } from "@/config/navigation"
import { ModeToggle } from "@/components/mode-toggle"

export default function Home() {
  return (
    <React.Fragment>
      <div className="flex min-h-screen flex-col">
        <header className="container z-40 bg-background">
          <div className="flex h-20 items-center justify-between py-6"> 
            <MainNav items={navigationgConfig.mainNav}/>
            <ModeToggle />
          </div>
        </header>
      </div>
    </React.Fragment>
  )
}