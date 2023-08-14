import type { Icon } from "lucide-react"
import { Icons } from "@/components/icons"

export interface MainNavItem  {
  title: string;
  href: string;
  description: string;
  disabled?: boolean;
} 

export interface NavItem {
  mainNav: MainNavItem[];
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