import type { Icon } from "lucide-react"
import { Icons } from "@/components/icons"

export type NavItem = { 
  title: string
  href: string
  description: string 
  disabled?: boolean
} 

export type MainNavItem = NavItem

export type components = {
  mainNav: MainNavItem[]
}

export type SiteConfig = {
  name: string
  description: string
  url: string
  ogImage: string
  links: {
    github: string
  }
}