import React from "react"
import { DashboardNav } from "@/components/navigation/nav"
import { MainNav } from "@/components/navigation/main-nav"
import { NavigationConfig } from "@/config/navigation"
import { dashboardConfig } from "@/config/dashboard"


import {
  SignedIn,
  UserButton,
} from "@clerk/nextjs";

interface UserLayoutProps {
    children: React.ReactNode
  }
  
  export default function UserLayout({ 
    children 
  }: UserLayoutProps) {
    return (
      <div className="flex min-h-screen flex-col space-y-6">
      <header className="sticky top-0 z-40 border-b bg-background">
        <div className="container flex h-16 items-center justify-between py-4">
          <MainNav items={NavigationConfig.NavItem}/>
          <SignedIn>
            <UserButton afterSignOutUrl="/" />
          </SignedIn>
        </div>
      </header>
      <div className="container grid flex-1 gap-12 md:grid-cols-[200px_1fr]">
        <aside className="hidden w-[200px] flex-col md:flex">
          <DashboardNav items={dashboardConfig.sidebarNav} />
        </aside>
        <main className="flex w-full flex-1 flex-col overflow-hidden">
          {children}
        </main>
      </div>
    </div>
    )
  }