import {
  mdiAccountGroup,
  mdiMonitor,
  mdiViewList,
  mdiFileDocumentCheckOutline,
  mdiPalette,
  mdiImageArea,
} from '@mdi/js'


export default function menuAside(isAdmin) {
  const menuItems = [
    {
      route: 'dashboard',
      icon: mdiMonitor,
      label: 'Dashboard',
    },
    {
      route: 'dashboard',
      label: 'Roles',
      icon: mdiViewList,
    },
    ...(isAdmin ? [
      {
        route: 'dashboard',
        label: 'Users',
        icon: mdiAccountGroup,
      }
    ] : []),
    {
      route: 'dashboard',
      label: 'Documents',
      icon: mdiFileDocumentCheckOutline,
    },
    {
      route: 'dashboard',
      label: 'Categories',
      icon: mdiPalette,
    },
    {
      route: 'dashboard',
      label: 'Media',
      icon: mdiImageArea,
    },
    // Tambahkan menu lainnya jika diperlukan
  ];

  return menuItems;
}