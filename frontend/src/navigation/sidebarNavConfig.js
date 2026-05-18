import {
  Home,
  Users,
  FileText,
  Clock,
  ClipboardList,
  CheckCircle,
  Calendar,
  BarChart3,
  UserCircle,
} from 'lucide-react-native';

/** @typedef {{ id: string, label: string, icon: any, path: string }} NavItem */

const PROFILE_ITEM = {
  id: 'profile',
  label: 'Profile',
  icon: UserCircle,
  path: '/profile',
};

/** @type {Record<string, NavItem[]>} */
const NAV_BY_ROLE = {
  'research-coordinator': [
    { id: 'research-groups', label: 'Research Groups', icon: Users, path: '/coordinator/research-groups' },
    { id: 'consolidated-reports', label: 'Consolidated Reports', icon: FileText, path: '/coordinator/consolidated-reports' },
    { id: 'history', label: 'History', icon: Clock, path: '/coordinator/history' },
  ],
  coordinator: [
    { id: 'dashboard', label: 'Dashboard', icon: Home, path: '/coordinator/dashboard' },
    { id: 'research-groups', label: 'Research Groups', icon: Users, path: '/coordinator/research-groups' },
    { id: 'book-binding-approval', label: 'Book Binding Approval', icon: CheckCircle, path: '/coordinator/book-binding' },
    { id: 'consolidated-reports', label: 'Consolidated Reports', icon: FileText, path: '/coordinator/consolidated-reports' },
    { id: 'history', label: 'History', icon: Clock, path: '/coordinator/history' },
  ],
  'panel-chair': [
    { id: 'research-groups', label: 'Research Groups', icon: Users, path: '/panelist/research-groups' },
    { id: 'consolidated-reports', label: 'Consolidated Reports', icon: FileText, path: '/panelist/consolidated-reports' },
    { id: 'history', label: 'History', icon: Clock, path: '/panelist/history' },
  ],
  panelist: [
    { id: 'dashboard', label: 'Dashboard', icon: Home, path: '/panelist/dashboard' },
    { id: 'evaluations', label: 'My Evaluations', icon: ClipboardList, path: '/panelist/evaluations' },
    { id: 'completed', label: 'Completed Evaluations', icon: CheckCircle, path: '/panelist/completed' },
  ],
  student: [
    { id: 'dashboard', label: 'Dashboard', icon: Home, path: '/student/dashboard' },
    { id: 'submissions', label: 'Submission Bin', icon: FileText, path: '/student/submissions' },
    { id: 'results', label: 'Results', icon: ClipboardList, path: '/student/results' },
    { id: 'schedule', label: 'Defense Schedule', icon: Calendar, path: '/student/schedule' },
  ],
  adviser: [
    { id: 'dashboard', label: 'Home', icon: Home, path: '/adviser/dashboard' },
    { id: 'students', label: 'My Students', icon: Users, path: '/adviser/students' },
    { id: 'submissions', label: 'Submissions', icon: FileText, path: '/adviser/submissions' },
  ],
  dean: [
    { id: 'dashboard', label: 'Dashboard', icon: Home, path: '/dean/dashboard' },
    { id: 'reports', label: 'Consolidated Reports', icon: FileText, path: '/dean/reports' },
    { id: 'analytics', label: 'College Analytics', icon: BarChart3, path: '/dean/analytics' },
  ],
  secretary: [
    { id: 'assigned-researches', label: 'Assigned Researches', icon: FileText, path: '/secretary/assigned-researches' },
    { id: 'submitted-evaluations', label: 'Submitted Evaluations', icon: CheckCircle, path: '/secretary/submitted-evaluations' },
    { id: 'history', label: 'History', icon: Clock, path: '/secretary/history' },
  ],
};

/**
 * Maps app user to sidebar role key used in NAV_BY_ROLE.
 * @param {Record<string, unknown> | null | undefined} user
 */
export function normalizeAppRole(user) {
  const raw = String(user?.loginRole || user?.role || '').toLowerCase();
  if (raw.includes('coordinator') || raw === 'admin' || raw === 'administrator') return 'coordinator';
  if (raw.includes('panel chair') || raw.includes('panel-chair')) return 'panel-chair';
  if (raw.includes('panel') || raw.includes('panelist')) return 'panelist';
  if (raw.includes('student')) return 'student';
  if (raw.includes('dean')) return 'dean';
  if (raw.includes('adviser') || raw.includes('advisor')) return 'adviser';
  if (raw.includes('secretary')) return 'secretary';
  return 'panelist';
}

/**
 * Badge color key for TopNav (subset of roles).
 * @param {Record<string, unknown> | null | undefined} user
 */
export function normalizeBadgeRole(user) {
  const raw = String(user?.loginRole || user?.role || '').toLowerCase();
  if (raw.includes('coordinator') || raw === 'admin' || raw === 'administrator') return 'coordinator';
  if (raw.includes('panel')) return 'panelist';
  if (raw.includes('student')) return 'student';
  if (raw.includes('dean')) return 'dean';
  if (raw.includes('adviser') || raw.includes('advisor')) return 'adviser';
  return 'panelist';
}

/**
 * @param {string} roleKey
 * @returns {NavItem[]}
 */
export function getNavigationItemsForRole(roleKey) {
  const base = NAV_BY_ROLE[roleKey] || NAV_BY_ROLE.panelist;
  return [...base, PROFILE_ITEM];
}

/**
 * Maps sidebar item id to main shell content tab.
 * @param {string} navId
 * @returns {'evaluation' | 'rubrics' | 'results' | 'profile'}
 */
export function getContentTabForNavId(navId) {
  if (navId === 'profile') return 'profile';
  const resultsIds = new Set([
    'consolidated-reports',
    'history',
    'completed',
    'reports',
    'analytics',
    'submitted-evaluations',
    'results',
  ]);
  const rubricsIds = new Set(['book-binding-approval', 'submissions']);
  if (resultsIds.has(navId)) return 'results';
  if (rubricsIds.has(navId)) return 'rubrics';
  return 'evaluation';
}
