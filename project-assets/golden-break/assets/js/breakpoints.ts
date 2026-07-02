function getCssVariable(name: string): number {
  const value = getComputedStyle(document.documentElement).getPropertyValue(
    name
  );
  return parseInt(value.trim().replace("px", ""), 10);
}

export const SCREEN_SM_MIN = getCssVariable('--screen-sm-min');
export const SCREEN_MD_MIN = getCssVariable('--screen-md-min');

