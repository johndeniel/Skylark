import type { Icon } from "lucide-react"
import { Icons } from "@/components/icons"
import { type } from "os";

export type MainNavItem = {
  title: string
  href: string
  description: string
  disabled?: boolean
} 

export type NavItem = {
  mainNav: MainNavItem[];
}

export type LatestUpdateType = {
  id: number
  name: string
  avatar: string
  content: String
}

export type LatestUpdate = {
  update: LatestUpdateType[];
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