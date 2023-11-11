import React from "react"
import { MainNav } from "@/components/navigation/main-nav"
import { NavigationConfig } from "@/config/navigation"
import { ModeToggle } from "@/components/ui/mode-toggle"


interface ViewportLayoutProps {
  children: React.ReactNode
}

export default async function ViewportLayout({
  children,
}: ViewportLayoutProps) {
  return (
    <div className="flex min-h-screen flex-col">
      <header className="container z-40 bg-background">
        <div className="flex h-20 items-center justify-between py-6"> 
          <MainNav items={NavigationConfig.NavItem}/>
          <ModeToggle />
        </div>
      </header>
      <main className="flex-1">{children}</main>
    </div>
  )
}